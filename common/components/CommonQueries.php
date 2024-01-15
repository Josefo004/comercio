<?php 
namespace common\components;
use PDO;
 
class CommonQueries 
{
    /**
     * Obtiene la fecha y hora en formato "dd mmm yyyy hh:mm" desde la base de datos
     * @return string fecha actual obtenida de BD
     * @throws Exception Se distapara la excepción producida en BD en caso de no ejecurtarse correctamente
     */
    public static function GetFechaHoraActual()
    {
        try {
            $sql =  'SELECT CONVERT(VARCHAR(17), GETDATE(), 113)[FechaHoraActual]';
            $command = \Yii::$app->db->createCommand($sql);
            $fechaHoraActual = $command->queryScalar();
        }catch (Exception $e) {
            \Yii::error("Error : ".$e);
            throw new Exception("Error : ".$e);
        }
        return $fechaHoraActual;
    }

    public static function GetFechaCompleta()
    {
        try {
            $sql =  'select dbo.formatoFecha (getdate(),2) [FechaActual]';
            $command = \Yii::$app->db->createCommand($sql);
            $fechaActual = $command->queryScalar();
        }catch (Exception $e) {
            \Yii::error("Error : ".$e);
            throw new Exception("Error : ".$e);
        }
        return $fechaActual;
    }
    
}