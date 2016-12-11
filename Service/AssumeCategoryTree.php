<?php
/**
 * @author Atwix Team
 * @copyright Copyright (c) 2016 Atwix (https://www.atwix.com/)
 * @package Atwix_AttributePool
 */

namespace Atwix\AttributePool\Service;

use Atwix\AttributePool\Helper\AttributePoolInterface;
use Magento\Framework\Data\Collection;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\Collection as CategoryCollection;

/**
 * Class CategoryTreeHelper
 */
class AssumeCategoryTree
{
    /**
     * @var CategoryCollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * @var AttributePoolInterface
     */
    protected $attributePool;

    /**
     * AssumeCategoryTree constructor.
     *
     * @param CategoryCollectionFactory $categoryCollectionFactory
     * @param AttributePoolInterface $attributePool
     */
    public function __construct(
        CategoryCollectionFactory $categoryCollectionFactory,
        AttributePoolInterface $attributePool
    ) {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->attributePool = $attributePool;
    }

    /**
     * Assume category tree
     *
     * @param $storeId
     * @param $rootId
     *
     * @return CategoryCollection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute($storeId, $rootId)
    {
        /** @var CategoryCollection $collection */
        $collection = $this->categoryCollectionFactory->create();
        $collection->setStoreId($storeId);
        $collection->addAttributeToSelect($this->attributePool->getAttributes());
        $collection->addFieldToFilter('path', ['like' => $rootId . '/%']); //load only from store root
        $collection->addAttributeToFilter('include_in_menu', 1);
        $collection->addIsActiveFilter();
        $collection->addUrlRewriteToResult();
        $collection->addOrder('level', Collection::SORT_ORDER_ASC);
        $collection->addOrder('position', Collection::SORT_ORDER_ASC);
        $collection->addOrder('parent_id', Collection::SORT_ORDER_ASC);
        $collection->addOrder('entity_id', Collection::SORT_ORDER_ASC);

        return $collection;
    }
    
}