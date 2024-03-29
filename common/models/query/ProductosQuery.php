<?php
namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Product]].
 *
 * @see \common\models\Product
 */
class ProductosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \common\models\query\ProductosQuery
     */
    public function publicado()
    {
        return $this->andWhere(['Publicado' => 1]);
    }

    //Productos publicados y que no esten eliminados
    public function publicado2()
    {
        return $this->where(['Publicado' => 1])->andWhere(['<>','CodigoEstado','D']);
    }

    public function id($id)
    {
        return $this->andWhere(['id' => $id]);
    }
}
