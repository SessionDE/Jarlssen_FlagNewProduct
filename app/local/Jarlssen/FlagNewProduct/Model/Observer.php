<?php
/**
 * @author      Tsvetan Stoychev <tsvetan.stoychev@jarlssen.de>
 * @website     http://www.jarlssen.de
 * @license http://opensource.org/licenses/osl-3.0.php Open Software Licence 3.0 (OSL-3.0)
 */

class Jarlssen_FlagNewProduct_Model_Observer
{

    /**
     * We check the date interval |new from - to| of a product
     * If the current date is in the interval then we
     * add property is_new = true to the product object
     *
     * @param Varien_Event_Observer $observer
     * @return Jarlssen_FlagNewProduct_Model_Observer
     */
    public function markProductAsNew(Varien_Event_Observer $observer)
    {
        $_product = $observer->getEvent()->getProduct();

        if($this->_isProductNew($_product)) {
            $_product->setIsNew(true);
        }

        return $this;
    }

    /**
     * We check the date interval |new from - to| of products in collection
     * If the current date is in the interval then we
     * add property is_new = true to the product object
     *
     * @param Varien_Event_Observer $observer
     * @return Jarlssen_FlagNewProduct_Model_Observer
     */
    public function markInCollectionAsNew(Varien_Event_Observer $observer)
    {
        $_collection = $observer->getEvent()->getCollection();

        foreach($_collection as $_product) {
            if($this->_isProductNew($_product)) {
                $_product->setIsNew(true);
            }
        }

        return $this;
    }

    /**
     * Check if the products is new.
     * Some date compare functions are involved.
     *
     * @param Mage_Catalog_Model_Product $_product
     * @return bool
     */
    protected function _isProductNew($_product)
    {
        $currentDate = date("Y-m-d");

        if($fromDate = $_product->getNewsFromDate() || $toDate = $_product->getNewsToDate()) {
            if( (empty($toDate) && $fromDate <= $currentDate)
             || (empty($fromDate) && $toDate >= $currentDate)
             || ($fromDate <= $currentDate && $toDate >= $currentDate)) {
                return true;
            }
        }

        return false;
    }

}