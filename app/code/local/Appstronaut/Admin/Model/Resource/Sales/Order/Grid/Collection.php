<?php
/**
 * @Company     Appstronaut Company
 * @package     Appstronaut_Admin
 * @Code by     Israel Guido (israelguido@gmail.com)
 * @copyright Copyright (c) 2017 (http://www.israelguido.com.br)
 * @license http://www.magento.com/license/enterprise-edition
 **/

class Appstronaut_Admin_Model_Resource_Sales_Order_Grid_Collection extends Mage_Sales_Model_Resource_Order_Grid_Collection
{
    /**
     * Get SQL for get record count
     *
     * @return Varien_Db_Select
     */
    public function getSelectCountSql()
    {
        if ($this->getIsCustomerMode()) {
            $this->_renderFilters();

            $unionSelect = clone $this->getSelect();

            $unionSelect->reset(Zend_Db_Select::ORDER);
            $unionSelect->reset(Zend_Db_Select::LIMIT_COUNT);
            $unionSelect->reset(Zend_Db_Select::LIMIT_OFFSET);

            $countSelect = clone $this->getSelect();
            $countSelect->reset();
            $countSelect->from(array('a' => $unionSelect), 'COUNT(*)');
        } else {
            $countSelect = parent::getSelectCountSql();
            $countSelect->joinLeft(
                array(
                    't1' => 'sales_flat_order'),
                't1.increment_id=main_table.increment_id',
                array('t1.customer_taxvat','t1.customer_email')
            );
        }

        return $countSelect;
    }
}