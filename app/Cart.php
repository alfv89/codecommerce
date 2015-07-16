<?php

namespace CodeCommerce;


class Cart
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @param $id
     * @param $name
     * @param $price
     */
    public function add($id, $name, $price)
    {
        $this->items += [
            $id => [
                'qtd' => isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++ : 1,
                'price' => $price,
                'name' => $name
            ]
        ];
    }

    /**
     * @param $id
     * @param $qtd
     */
    public function changeQuantity($id, $qtd)
    {
        if($qtd > 0) {
            $this->items[$id]['qtd'] = $qtd;
        } else {
            unset($this->items[$id]);
        }

    }

    /**
     * @param $id
     */
    public function remove($id)
    {
        unset($this->items[$id]);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        $total = 0.00;

        foreach($this->items as $item) {
            $total += $item['qtd'] * $item['price'];
        }

        return $total;
    }
}