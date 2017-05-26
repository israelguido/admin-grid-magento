<?php

/**
 * @Company     Appstronaut Company
 * @package     Appstronaut_Admin
 * @Code by     Israel Guido (israelguido@gmail.com)
 * @copyright Copyright (c) 2017 (http://www.israelguido.com.br)
 * @license http://www.magento.com/license/enterprise-edition
 **/

class Appstronaut_Admin_Model_Observer
{
    public function salesOrderGridCollectionLoadBefore(Varien_Event_Observer $observer)
    {
        $collection = $observer->getOrderGridCollection();
        $select = $collection->getSelect();
        $select->joinLeft(array(
            't1' => $collection->getTable('sales/order')),
            't1.increment_id=main_table.increment_id',
            array('t1.customer_email')
        );
    }
}
