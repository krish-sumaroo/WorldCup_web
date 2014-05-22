<?php

class BaseStadiumLogicUtility
{
    //table name
    public static $TABLE_NAME = "stadium";
    //fields list
    public static $ID_FIELD = "id";
    public static $NAME_FIELD = "name";
    public static $IMAGE_FIELD = "image";
    //fields values
    //fields limits
    public static $ID_LIMIT = 11;
    public static $NAME_LIMIT = 50;
    public static $IMAGE_LIMIT = 30;

    public static function addStadium($name, $image)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseStadiumLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseStadiumLogicUtility::$NAME_FIELD, $name);
        $queryBuilder->addUpdateField(BaseStadiumLogicUtility::$IMAGE_FIELD, $image);

        return $queryBuilder->executeInsertQuery();
    }

    public static function getStadiumDetails($id)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseStadiumLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseStadiumLogicUtility::addAllFields($queryBuilder);
        $queryBuilder->addAndConditionWithValue(BaseStadiumLogicUtility::$ID_FIELD, $id);
        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseStadiumLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }

    }

    public static function updateStadium($id, $name, $image)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseStadiumLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseStadiumLogicUtility::$NAME_FIELD, $name);
        $queryBuilder->addUpdateField(BaseStadiumLogicUtility::$IMAGE_FIELD, $image);

        $queryBuilder->addAndConditionWithValue(BaseStadiumLogicUtility::$ID_FIELD, $id);

        return $queryBuilder->executeUpdateQuery();
    }

    public static function getStadiumList(SortQuery $sortQuery = null)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseStadiumLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseStadiumLogicUtility::addAllFields($queryBuilder);

        if($sortQuery)
        {
            $queryBuilder->addSortQuery($sortQuery);
        }

        $result = $queryBuilder->executeQuery();

        return BaseStadiumLogicUtility::convertToObjectArray($result);
    }

    public static function deleteStadium($id)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseStadiumLogicUtility::$TABLE_NAME);
        $queryBuilder->addAndConditionWithValue(BaseStadiumLogicUtility::$ID_FIELD, $id);

        return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseStadiumLogicUtility::$TABLE_NAME);
        $queryBuilder->addField($field);
        $queryBuilder->addAndConditionWithValue(BaseStadiumLogicUtility::$ID_FIELD, $id);

        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseStadiumLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }
    }

    public static function getId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseStadiumLogicUtility::$ID_FIELD);
    }

    public static function getName($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseStadiumLogicUtility::$NAME_FIELD);
    }

    public static function getImage($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseStadiumLogicUtility::$IMAGE_FIELD);
    }


    protected static function updateSpecificField($id, $field, $value)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseStadiumLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
        $queryBuilder->addAndConditionWithValue(BaseStadiumLogicUtility::$ID_FIELD, $id);

        $result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateName($id, $value)
    {
        BaseStadiumLogicUtility::updateSpecificField($id, $value, BaseStadiumLogicUtility::$NAME_FIELD, $value);
    }

    public static function updateImage($id, $value)
    {
        BaseStadiumLogicUtility::updateSpecificField($id, $value, BaseStadiumLogicUtility::$IMAGE_FIELD, $value);
    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addFields(BaseStadiumLogicUtility::$ID_FIELD);
        $queryBuilder->addFields(BaseStadiumLogicUtility::$NAME_FIELD);
        $queryBuilder->addFields(BaseStadiumLogicUtility::$IMAGE_FIELD);

        return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
        $objectArray = array();

        for($i = 0; $i < count($result); $i++)
        {
            $objectArray[$i] = BaseStadiumLogicUtility::convertToObject($result[$i]);
        }

        return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
        $id = QueryBuilder::getQueryValue($resultDetails, BaseStadiumLogicUtility::$ID_FIELD);
        $name = QueryBuilder::getQueryValue($resultDetails, BaseStadiumLogicUtility::$NAME_FIELD);
        $image = QueryBuilder::getQueryValue($resultDetails, BaseStadiumLogicUtility::$IMAGE_FIELD);

        return new StadiumEntity($id, $name, $image, $resultDetails);
    }
}

?>
