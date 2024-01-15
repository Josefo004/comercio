<?php
namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Product]].
 *
 * @see \common\models\ProDetalleTallasduct
 */
class DetalleTallasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\DetalleTallas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\DetalleTallas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return \common\models\query\ProductosQuery
     */
    public function DetalleTallas($idTalla)
    {
        return $this->andWhere(['IdTalla' => $idTalla]);
    }
    
}
