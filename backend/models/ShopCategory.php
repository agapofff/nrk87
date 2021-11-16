<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%shop_category}}".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string|null $code
 * @property string|null $slug
 * @property string|null $text
 * @property string|null $image
 * @property int $sort
 *
 * @property ShopProduct[] $shopProducts
 * @property ShopProductToCategory[] $shopProductToCategories
 */
class ShopCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%shop_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort'], 'integer'],
            [['name'], 'required'],
            [['name', 'text', 'image'], 'string'],
            [['code', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('back', 'ID'),
            'parent_id' => Yii::t('back', 'Parent ID'),
            'name' => Yii::t('back', 'Name'),
            'code' => Yii::t('back', 'Code'),
            'slug' => Yii::t('back', 'Slug'),
            'text' => Yii::t('back', 'Text'),
            'image' => Yii::t('back', 'Image'),
            'sort' => Yii::t('back', 'Sort'),
        ];
    }

    /**
     * Gets query for [[ShopProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShopProducts()
    {
        return $this->hasMany(ShopProduct::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[ShopProductToCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShopProductToCategories()
    {
        return $this->hasMany(ShopProductToCategory::className(), ['category_id' => 'id']);
    }
}
