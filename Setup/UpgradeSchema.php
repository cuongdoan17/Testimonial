<?php


namespace AHT\Testimonial\Setup;


use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;

        $installer->startSetup();

        if(version_compare($context->getVersion(), '2.0.1', '<')) {
            $installer->getConnection()->addIndex(
                $installer->getTable('aht_blog_author'),
                $setup->getIdxName(
                    $installer->getTable('aht_blog_author'),
                    ['author_name', 'author_email'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['author_name', 'author_email'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );

            $installer->getConnection()->addIndex(
                $installer->getTable('aht_testimonial_blog'),
                $setup->getIdxName(
                    $installer->getTable('aht_testimonial_blog'),
                    ['name', 'email', 'designation'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name', 'email', 'designation'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }



        $installer->endSetup();
    }
}
