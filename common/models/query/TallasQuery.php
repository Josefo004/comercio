<?php
namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Product]].
 *
 * @see \common\models\Product
 */
class TallasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Tallas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Tallas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \common\models\query\ProductosQuery
     */
    public function IdProducto($idProducto)
    {
        return $this->andWhere(['IdProducto' => $idProducto]);
    }

    public function idTalla($idTalla)
    {
        return $this->andWhere(['idTalla' => $idTalla]);
    }
}
