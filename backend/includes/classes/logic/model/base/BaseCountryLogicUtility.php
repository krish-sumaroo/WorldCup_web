<?php

class BaseCountryLogicUtility
{
    //table name
    public static $TABLE_NAME = "country";
    //fields list
    public static $ID_FIELD = "id";
    public static $NAME_FIELD = "name";
    //fields values
    //fields limits
    public static $ID_LIMIT = 11;
    public static $NAME_LIMIT = 30;

    public static function addCountry($name)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseCountryLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseCountryLogicUtility::$NAME_FIELD, $name);

        return $queryBuilder->executeInsertQuery();
    }

    public static function getCountryDetails($id)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseCountryLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseCountryLogicUtility::addAllFields($queryBuilder);
        $queryBuilder->addAndConditionWithValue(BaseCountryLogicUtility::$ID_FIELD, $id);
        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseCountryLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }

    }

    public static function updateCountry($id, $name)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseCountryLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField(BaseCountryLogicUtility::$NAME_FIELD, $name);

        $queryBuilder->addAndConditionWithValue(BaseCountryLogicUtility::$ID_FIELD, $id);

        return $queryBuilder->executeUpdateQuery();
    }

    public static function getCountryList(SortQuery $sortQuery = null)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseCountryLogicUtility::$TABLE_NAME);
        $queryBuilder = BaseCountryLogicUtility::addAllFields($queryBuilder);

        if($sortQuery)
        {
            $queryBuilder->addSortQuery($sortQuery);
        }

        $result = $queryBuilder->executeQuery();

        return BaseCountryLogicUtility::convertToObjectArray($result);
    }

    public static function deleteCountry($id)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseCountryLogicUtility::$TABLE_NAME);
        $queryBuilder->addAndConditionWithValue(BaseCountryLogicUtility::$ID_FIELD, $id);

        return $queryBuilder->executeDeleteQuery();
    }

    protected static function getSpecificDetails($id, $field)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseCountryLogicUtility::$TABLE_NAME);
        $queryBuilder->addField($field);
        $queryBuilder->addAndConditionWithValue(BaseCountryLogicUtility::$ID_FIELD, $id);

        $result = $queryBuilder->executeQuery();

        if(count($result) > 0)
        {
            return BaseCountryLogicUtility::convertToObject($result[0]);
        }
        else
        {
            return null;
        }
    }

    public static function getId($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseCountryLogicUtility::$ID_FIELD);
    }

    public static function getName($id)
    {
        return BaseBannerLogicUtility::getSpecificDetails($id, BaseCountryLogicUtility::$NAME_FIELD);
    }


    protected static function updateSpecificField($id, $field, $value)
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->addTable(BaseCountryLogicUtility::$TABLE_NAME);
        $queryBuilder->addUpdateField($field, $value, QueryBuilder::$DOUBLE_QUOTE);
        $queryBuilder->addAndConditionWithValue(BaseCountryLogicUtility::$ID_FIELD, $id);

        $result = $queryBuilder->executeUpdateQuery();
    }

    public static function updateName($id, $value)
    {
        BaseCountryLogicUtility::updateSpecificField($id, $value, BaseCountryLogicUtility::$NAME_FIELD, $value);
    }


    public static function addAllFields(QueryBuilder $queryBuilder)
    {
        $queryBuilder->addFields(BaseCountryLogicUtility::$ID_FIELD);
        $queryBuilder->addFields(BaseCountryLogicUtility::$NAME_FIELD);

        return $queryBuilder;
    }

    public static function convertToObjectArray($result)
    {
        $objectArray = array();

        for($i = 0; $i < count($result); $i++)
        {
            $objectArray[$i] = BaseCountryLogicUtility::convertToObject($result[$i]);
        }

        return $objectArray;
    }

    public static function convertToObject($resultDetails)
    {
        $id = QueryBuilder::getQueryValue($resultDetails, BaseCountryLogicUtility::$ID_FIELD);
        $name = QueryBuilder::getQueryValue($resultDetails, BaseCountryLogicUtility::$NAME_FIELD);

        return new CountryEntity($id, $name, $resultDetails);
    }
}

?>
