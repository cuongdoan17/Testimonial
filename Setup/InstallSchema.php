<?php


namespace AHT\Testimonial\Setup;


class   InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('aht_testimonial_blog')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('aht_testimonial_blog')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'ID'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Name'
                )
                ->addColumn(
                    'email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Email'
                )
                ->addColumn(
                    'designation',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '255',
                    [],
                    'Designation'
                )
                ->addColumn(
                    'contact',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    [],
                    'Contact'
                )
                ->addColumn(
                    'message',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '2k',
                    [],
                    'Message'
                )
                ->addColumn(
                    'image',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Image'
                )
                ->addColumn(
                    'author_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['unsigned' => true, 'nullable'=>false],
                    'Author Foreignkey'
                )
                ->addForeignKey(
                    $setup->getFkName(
                        'aht_testimonial_blog',
                        'author_id',
                        'aht_blog_author',
                        'author_id'),
                    'author_id',
                    $setup->getTable('aht_blog_author'),
                    'author_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => true],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => true],
                    'Updated At')
                ->setComment('Post Table');
            $installer->getConnection()->createTable($table);

            $table = $installer->getConnection()
                ->newTable($installer->getTable(  'aht_blog_author'))
                ->addColumn(
                    'author_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true, 'nullable'=>false, 'primary'=>true,'unsigned' => true],
                    'Author ID'
                )
                ->addColumn(
                    'author_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'=>false
                    ],
                    'Author Name'
                )
                ->addColumn(
                    'author_email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'=>false
                    ],
                    'Author Email'
                )
                ->setComment('Blog Author');
            $setup->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
