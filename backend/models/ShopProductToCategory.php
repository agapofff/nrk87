<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%shop_product_to_category}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $category_id
 *
 * @property ShopProduct $product
 * @property ShopCategory $category
 */
class ShopProductToCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%shop_product_to_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'category_id'], 'required'],
            [['product_id', 'category_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'product_id' => Yii::t('back', 'Product ID'),
            'category_id' => Yii::t('back', 'Category ID'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ShopProduct::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ShopCategory::className(), ['id' => 'category_id']);
    }
}
