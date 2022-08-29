<?php

namespace App\Models;

use App\Models\Util\{IsFile, ModelFile};

use Carbon\Carbon;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Dat extends Model implements ModelFile
{
    use IsFile, SoftDeletes;

    /**
     * Every file has the `.dat` extension.
     *
     * @var string
     */
    public const EXT = 'dat';

    /**
     * The lines of a `.dat` file are
     * separated by this character.
     *
     * @var string
     */
    public const SEPARATOR = 'ç';

    /**
     * Every line with this ID
     * mark a **Seller**.
     *
     * @var string
     */
    private const ID_SELLER = '001';

    /**
     * Every line with this ID
     * mark a **Customer**.
     *
     * @var string
     */
    private const ID_CUSTOMER = '002';

    /**
     * Every line with this ID
     * mark a **Sale**.
     *
     * @var string
     */
    private const ID_SALE = '003';

    /** @inheritDoc */
    protected $casts = [
        'first_read_at' => 'datetime',
        'last_read_at'  => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime'
    ];

    /**
     * Additionally has two new attributes for the files:
     * * **name:** Return a string on the format `id.ext`;
     * * **file:** Get the contents of the stored file, or return `null`.
     *
     * For other `$key`s, it calls its parents implementations.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        switch($key)
        {
            case 'name': return $this->getFileName($this->id, self::EXT);
            case 'file': return app('storage')::disk('local')->get(
                "{$this->getDataPath()}/{$this->getFileName($this->id, self::EXT)}"
            );
            default:     return parent::__get($key);
        }
    }

    /**
     * Validate if an uploaded file is actually a valid `.dat` file.
     *
     * @param UploadedFile $file
     * @return bool
     */
    public static function validate(UploadedFile $file): bool
    {
        if($file->getClientOriginalExtension() === Dat::EXT)
        {
            return (substr_count(trim($file->getContent()), Dat::SEPARATOR) % 3) == 0;
        }

        return false;
    }

    /**
     * The returned `array` contains three keys:
     * * **sellers:** An `array` with CPF, Name and Wage;
     * * **Customers:** An `array` with CNPJ, Name and Business Branch;
     * * **sales:** An `array` with ID, Seller and also another `array`
     * of items with theirs ID, Price and Quantity;
     *
     * @return array
     */
    public function read(): array
    {
        /**
         * The Data array to return.
         *
         * @var array $data
         */
        $data = [
            'sellers'   => [],
            'customers' => [],
            'sales'     => []
        ];

        if($this->file)
        {
            foreach(preg_split('/\n|\r\n?/', trim($this->file)) as $line)
            {
                /**
                 * The information on the current line, grouped.
                 *
                 * @var string[] $infos
                 */
                $infos = explode(self::SEPARATOR, $line);

                /**
                 * The ID of the line.
                 *
                 * Can be:
                 * * **001**
                 * * **002**
                 * * **003**
                 *
                 * @var string $id
                 */
                $id = $infos[0];

                array_splice($infos, 0, 1);

                switch($id)
                {
                    case self::ID_SELLER:
                        [$cpf, $name, $wage] = $infos;

                        /**
                         * The formatted CPF.
                         *
                         * ( *xxx.xxx.xxx-xx* )
                         *
                         * @var string $cpf
                         */
                        $cpf  = $this->makeCPF($cpf);

                        /**
                         * The name of the seller or
                         * customer, separated with spaces.
                         *
                         * @var string $name
                         */
                        $name = $this->makeName($name);

                        /**
                         * The current wage of the
                         * seller.
                         *
                         * @var float $wage
                         */
                        $wage = (float) $wage;

                        $data['sellers'][] = compact('cpf', 'name', 'wage');
                    break;

                    case self::ID_CUSTOMER:
                        [$cnpj, $name, $branch] = $infos;

                        /**
                         * The formatted CNPJ.
                         *
                         * ( *xx.xxx.xxx/xxxx-xx* )
                         *
                         * @var string $cnpj
                         */
                        $cnpj = $this->makeCNPJ($cnpj);

                        /**
                         * The name of the seller or
                         * customer, separated with spaces.
                         *
                         * @var string $name
                         */
                        $name = $this->makeName($name);

                        /**
                         * The current business branch
                         * of the customer.
                         *
                         * @var string $branch
                         */
                        $branch = $this->makeName($branch);

                        $data['customers'][] = compact('cnpj', 'name', 'branch');
                    break;

                    case self::ID_SALE:
                        [$id, $items, $seller] = $infos;

                        /**
                         * The ID of the sale.
                         *
                         * @var int $id
                         */
                        $id = (int) $id;

                        /**
                         * All items sold.
                         *
                         * @var array $items
                         */
                        $items = $this->makeItems((string) $items);

                        /**
                         * The name of the seller,
                         * separated with spaces.
                         *
                         * @var string $seller
                         */
                        $seller = $this->makeName($seller);

                        $data['sales'][] = compact('id', 'items', 'seller');
                    break;
                }
            }

            $this->last_read_at = Carbon::now();

            $this->save();
        }

        return $data;
    }

    /**
     * Relate with the User who uploaded the file,
     * belonging to it.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @inheritDoc */
    public function toArray()
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'first_read'  => $this->first_read_at->format('Y-m-d h:i:s'),
            'last_read'   => $this->last_read_at->format('Y-m-d h:i:s'),
            'user'        => [
                'id'   => $this->user->id,
                'name' => $this->user->name
            ]
        ];
    }

    /**
     * Make a CPF from a numbered `string`.
     *
     * The format consists on: *xxx.xxx.xxx-xx*
     *
     * @param string $str
     * @return string
     */
    private function makeCPF(string $str): string
    {
        if(strlen($str) != 11 || !is_numeric($str))
        {
            return $str;
        }

        $cpf  =     substr($str, 0, 3);
        $cpf .= '.'.substr($str, 3, 3);
        $cpf .= '.'.substr($str, 5, 3);
        $cpf .= '-'.substr($str, 8, 2);

        return $cpf;
    }

    /**
     * Make a CNPJ from a numbered `string`.
     *
     * The format consists on: *xx.xxx.xxx/xxxx-xx*
     *
     * @param string $str
     * @return string
     */
    private function makeCNPJ(string $str): string
    {
        if(strlen($str) != 14 || !is_numeric($str))
        {
            return $str;
        }

        $cnpj  =     substr($str, 0,  2);
        $cnpj .= '.'.substr($str, 2,  3);
        $cnpj .= '.'.substr($str, 5,  3);
        $cnpj .= '/'.substr($str, 9,  4);
        $cnpj .= '-'.substr($str, 13, 2);

        return $cnpj;
    }

    /**
     * Break a pascal case `string` into a name.
     *
     * @param string $str
     * @return string
     */
    private function makeName(string $str): string
    {
        $name = preg_split('/(?=[A-Z])/', $str);
        $name = implode(' ', $name);
        $name = trim($name);

        return $name;
    }

    /**
     * Convert a stringified `array` into an actual `array`.
     *
     * @param string $str
     * @return array
     */
    private function makeItems(string $str): array
    {
        $items = preg_replace('/[\[\]]/', '', $str);
        $items = trim($items);
        $items = explode(',', $items);
        $items = array_map(
            function($item) {
                [$id, $quantity, $price] = explode('-', $item);

                return [
                    'id'       => (int)   $id,
                    'quantity' => (int)   $quantity,
                    'price'    => (float) $price
                ];
            },
            $items
        );

        return $items;
    }
}
