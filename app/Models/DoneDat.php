<?php

namespace App\Models;

use App\Models\Util\{IsFile, ModelFile};

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class DoneDat extends Model implements ModelFile
{
    use IsFile, SoftDeletes;

    /**
     * Every file has the `.done.dat` extension.
     *
     * @var string
     */
    public const EXT = 'done.dat';

    /**
     * The lines of a `.done.dat` file are
     * single-value only and must be broke
     *  by this character.
     *
     * @var string
     */
    public const BREAKER = "\n";

    /**
     * The line of the customers quantity.
     *
     * @var int
     */
    public const LINE_CUSTOMERS_QTD = 0;

    /**
     * The line of the sellers quantity.
     *
     * @var int
     */
    public const LINE_SELLERS_QTD = 1;

    /**
     * The line of the most expensive sale.
     *
     * @var int
     */
    public const LINE_MOST_EXP_SALE = 2;

    /**
     * The line of the worst seller.
     *
     * @var int
     */
    public const LINE_WORST_SELLER = 3;

    /** @inheritDoc */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * Get a list of `.dat` files, read their data
     * and make the dump `array`.
     *
     * @param iterable $dats
     * @return array
     */
    final public static function make(iterable $dats): array
    {
        /**
         * The dumped data `array`.
         *
         * @var array $dump
         */
        $dump = [
            self::LINE_CUSTOMERS_QTD => null,
            self::LINE_SELLERS_QTD   => null,
            self::LINE_MOST_EXP_SALE => null,
            self::LINE_WORST_SELLER  => null,
        ];

        /**
         * The best price of all sales.
         *
         * @var null $bestPrice
         */
        $bestPrice = null;

        /**
         * The worst price of all sales.
         *
         * @var null $bestPrice
         */
        $worstPrice = null;

        /**
         * Already get names of customers.
         *
         * @var array $customers
         */
        $customers = [];

        /**
         * Already get names of sellers.
         *
         * @var array $sellers
         */
        $sellers = [];

        /**
         * @var int|string $index
         * @var Dat|mixed $dat
         */
        foreach($dats as $index => $dat)
        {
            if($dat instanceof Dat)
            {
                /**
                 * The read data.
                 *
                 * @var array $data
                 */
                $data = $dat->read();

                self::countPersons($dump, self::LINE_CUSTOMERS_QTD, $customers, $data['customers']);
                self::countPersons($dump, self::LINE_SELLERS_QTD, $sellers, $data['sellers']);

                if
                (
                    !$dump[self::LINE_MOST_EXP_SALE] &&
                    !$dump[self::LINE_WORST_SELLER]  &&
                    count($data['sales']) >= 1
                )
                {
                    $dump[self::LINE_MOST_EXP_SALE] = $data['sales'][0]['id'];
                    $dump[self::LINE_WORST_SELLER]  = $data['sales'][0]['seller'];
                }

                foreach($data['sales'] as $sale)
                {
                    foreach($sale['items'] as $item)
                    {
                        /** @var float $bestPrice */
                        $bestPrice = $bestPrice ?? $item['price'];

                        /** @var float $worstPrice */
                        $worstPrice = $worstPrice ?? $item['price'];

                        if($item['price'] > $bestPrice)
                        {
                            $dump[self::LINE_MOST_EXP_SALE] = $sale['id'];
                        }

                        if($item['price'] < $worstPrice)
                        {
                            $dump[self::LINE_WORST_SELLER] = $sale['seller'];
                        }
                    }
                }

                continue;
            }

            throw new \InvalidArgumentException(
                'Argument #1 ($dats) contains not a instance of '.Dat::class." on index [{$index}]: Given ".gettype($dat)
            );
        }

        return $dump;
    }

    /**
     * Stringify a dump array to a file, breaking
     * it into each line.
     *
     * @param array $dump
     * @return string
     */
    final public static function stringify(array $dump): string
    {
        return implode(self::BREAKER, $dump);
    }

    /**
     * Iterate through the `$data`, counting the
     * the ones not present in the `&$safe` (also
     * putting them on it), and finally saving
     * the result on the `$line` of the `&$dump`.
     *
     * @param array &$dump
     * @param int $line
     * @param array &$safe
     * @param array $data
     * @return void
     */
    private static function countPersons(
        array &$dump,
        int $line,
        array &$safe,
        array $data
    ): void
    {
        foreach($data as $item)
        {
            if(in_array($item['name'], $safe, true))
            {
                continue;
            }

            $dump[$line]++;

            $safe[] = $item['name'];
        }
    }

    /**
     * The returned `array` contains four keys:
     * * **customers_quantity:** An `int` with the total of customers;
     * * **sellers_quantity:** An `int` with the total of sellers;
     * * **most_expensive_sale_id:** An `int` with the ID of the most expensive sale;
     * * **worst_seller:** A `string` with the worst seller name.
     *
     * @return array
     */
    public function read(): array
    {
        $data = [
            'customers_quantity'     => null,
            'sellers_quantity'       => null,
            'most_expensive_sale_id' => null,
            'worst_seller'           => null
        ];

        if($this->file)
        {
            $infos = explode(self::BREAKER, $this->file);

            foreach(array_keys($data) as $index => $key)
            {
                $data[$key] = $infos[$index];

                if($key !== 'worst_seller')
                {
                    $data[$key] = (int) $data[$key];
                }
            }
        }

        return $data;
    }

    /** @inheritDoc */
    public function toArray()
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'creation' => $this->created_at->format('Y-m-d h:i:s')
        ];
    }
}
