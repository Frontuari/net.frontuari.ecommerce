<?php

namespace App\Services;

use Illuminate\Support\Collection;

class IdempiereService
{
    public function extractProductData($responseData)
    {

        // Verificar si la respuesta ya es un array
        if (!is_array($responseData)) {
            return [];
        }

        // Verificar si existen los datos esperados
        if (
            !isset($responseData['getProductAPP']['WindowTabData']['DataSet']['DataRow']) ||
            empty($responseData['getProductAPP']['WindowTabData']['DataSet']['DataRow'])
        ) {
            return [];
        }




        // Obtener los registros de productos
        $dataRows = $responseData['getProductAPP']['WindowTabData']['DataSet']['DataRow'];

        // Asegurar que sea un array de registros
        if (!is_array($dataRows) || isset($dataRows['field'])) {
            $dataRows = [$dataRows]; // Convertir en array si solo hay un elemento
        }


        $productsData = [];

        foreach ($dataRows as $row) {
            // Validar que 'field' exista y sea un array
            if (!isset($row['field']) || !is_array($row['field'])) {
                continue;
            }

            // Usar Collection para buscar datos más eficientemente
            $fields = collect($row['field'])->mapWithKeys(fn($item) => [$item['@column'] => $item['val']]);

            $productsData[] = [
                'cod_product'        => $fields->get('Value'),
                'm_product_id'       => $fields->get('M_Product_ID'),
                'name'               => $fields->get('Name'),
                'price'              => $fields->get('PriceList'),
                'quantity'           => $fields->get('QtyOnHand'),
                'pro_cat_id'         => $fields->get('M_Product_Category_ID'),
                'categoria'          => $fields->get('category_name', ''),
                'product_type'       => $fields->get('ProductType'),
                'product_type_name'  => $fields->get('producttype_name'),
                'tax_cat_id'         => $fields->get('C_TaxCategory_ID'),
                'tax_cat_name'       => $fields->get('taxcategory_name'),
                'product_group_id'   => $fields->get('FTU_ProductGroup_ID'),
                'product_group_name' => $fields->get('FTU_ProductGroup_Name'),
                'um_id'              => $fields->get('C_UOM_ID'),
                'um_name'            => $fields->get('UOMName'),
                'quantity_sold'      => 0, // Default
                'pricelistsales'     => $fields->get('pricelistsales'),
            ];
        }




        return $productsData;
    }

public function extracTaxtData($responseData)
    {

    
        // Verificar si la respuesta ya es un array
        if (!is_array($responseData)) {
            return [];
        }

        // Verificar si existen los datos esperados
        if (
            !isset($responseData['EFTU_getTax']['WindowTabData']['DataSet']['DataRow']) ||
            empty($responseData['EFTU_getTax']['WindowTabData']['DataSet']['DataRow'])
        ) {
            return [];
        }

        // Obtener los registros de productos
        $dataRows = $responseData['EFTU_getTax']['WindowTabData']['DataSet']['DataRow'];

        // Asegurar que sea un array de registros
        if (!is_array($dataRows) || isset($dataRows['field'])) {
            $dataRows = [$dataRows]; // Convertir en array si solo hay un elemento
        }

        $taxData = [];

        foreach ($dataRows as $row) {
            // Validar que 'field' exista y sea un array
            if (!isset($row['field']) || !is_array($row['field'])) {
                continue;
            }

            // Usar Collection para buscar datos más eficientemente
            $fields = collect($row['field'])->mapWithKeys(fn($item) => [$item['@column'] => $item['val']]);

            $taxData[] = [
                'c_tax_id'           => $fields->get('EFTU_RV_Tax_ID'),
                'tax_indicator'      => $fields->get('TaxIndicator'),
                'rate'               => $fields->get('Rate'),
                'name'               => $fields->get('Name'),
                'c_tax_category_id'  => $fields->get('C_TaxCategory_ID'),
                'iswithholding'      => $fields->get('IsWithholding'),
            ];
        }



        return $taxData;
    }

    public function extractWarehouse($responseData)
    {

        // Verificar si la respuesta ya es un array
        if (!is_array($responseData)) {
            return [];
        }


        // Verificar si existen los datos esperados
        if (
            !isset($responseData['getWarehouseAPP']['WindowTabData']['DataSet']['DataRow']) ||
            empty($responseData['getWarehouseAPP']['WindowTabData']['DataSet']['DataRow'])
        ) {
            return [];
        }


        // Obtener los registros de productos
        $dataRows = $responseData['getWarehouseAPP']['WindowTabData']['DataSet']['DataRow'];

        // Asegurar que sea un array de registros
        if (!is_array($dataRows) || isset($dataRows['field'])) {
            $dataRows = [$dataRows]; // Convertir en array si solo hay un elemento
        }

        $wareHouseData = [];

        foreach ($dataRows as $row) {
            // Validar que 'field' exista y sea un array
            if (!isset($row['field']) || !is_array($row['field'])) {
                continue;
            }

            // Usar Collection para buscar datos más eficientemente
            $fields = collect($row['field'])->mapWithKeys(fn($item) => [$item['@column'] => $item['val']]);

            $wareHouseData[] = [
                'ad_client_id'           => $fields->get('AD_Client_ID'),
                'ad_org_id'      => $fields->get('AD_Org_ID'),
                'm_warehouse_id'               => $fields->get('M_Warehouse_ID'),
                'name'               => $fields->get('WarehouseName'),
                'value'  => $fields->get('WarehouseValue')

            ];
        }



        return $wareHouseData;
    }

    public function extractConversion($responseData)
    {

        // Verificar si la respuesta ya es un array
        if (!is_array($responseData)) {
            return [];
        }
        // Verificar si existen los datos esperados
        if (
            !isset($responseData['getRateConversion']['WindowTabData']['DataSet']['DataRow']) ||
            empty($responseData['getRateConversion']['WindowTabData']['DataSet']['DataRow'])
        ) {
            return [];
        }


        // Obtener los registros de productos
        $dataRows = $responseData['getRateConversion']['WindowTabData']['DataSet']['DataRow'];


        // Asegurar que sea un array de registros
        if (!is_array($dataRows) || isset($dataRows['field'])) {
            $dataRows = [$dataRows]; // Convertir en array si solo hay un elemento
        }

        $coinData = [];

        foreach ($dataRows as $row) {
            // Validar que 'field' exista y sea un array
            if (!isset($row['field']) || !is_array($row['field'])) {
                continue;
            }

            // Usar Collection para buscar datos más eficientemente
            $fields = collect($row['field'])->mapWithKeys(fn($item) => [$item['@column'] => $item['val']]);

            $coinData[] = [
                'name' =>'nameCoinIdempiere',
                'symbol' =>'symbolCoinIdempiere',
                'rate'               => $fields->get('MultiplyRate'),
                'C_Currency_ID_To'               => $fields->get('C_Currency_ID_To'),
            ];
        }

     
        return $coinData;
    }

    public function extractCategory($responseData)
    {
        // Verificar si la respuesta ya es un array
        if (!is_array($responseData)) {
            return [];
        }
        // Verificar si existen los datos esperados
        if (
            !isset($responseData['EFTU_getProductCategory']['WindowTabData']['DataSet']['DataRow']) ||
            empty($responseData['EFTU_getProductCategory']['WindowTabData']['DataSet']['DataRow'])
        ) {
            return [];
        }


        // Obtener los registros de productos
        $dataRows = $responseData['EFTU_getProductCategory']['WindowTabData']['DataSet']['DataRow'];


        // Asegurar que sea un array de registros
        if (!is_array($dataRows) || isset($dataRows['field'])) {
            $dataRows = [$dataRows]; // Convertir en array si solo hay un elemento
        }

        $categoryData = [];

        foreach ($dataRows as $row) {
            // Validar que 'field' exista y sea un array
            if (!isset($row['field']) || !is_array($row['field'])) {
                continue;
            }

            // Usar Collection para buscar datos más eficientemente
            $fields = collect($row['field'])->mapWithKeys(fn($item) => [$item['@column'] => $item['val']]);

            $categoryData[] = [
                'idCategory' =>$fields->get('EFTU_RV_ProductCategory_ID'),
                'name' =>$fields->get('ftu_productgroup_name'),
                'status' =>$fields->get('ecommerce_isactive'),
                'adulto'=>$fields->get('adulto'),
                
            ];
        }
        return $categoryData;
    }
    public function extractSubCategory($responseData)
    {

        // Verificar si la respuesta ya es un array
        if (!is_array($responseData)) {
            return [];
        }
        // Verificar si existen los datos esperados
        if (
            !isset($responseData['EFTU_getProductSubCategory']['WindowTabData']['DataSet']['DataRow']) ||
            empty($responseData['EFTU_getProductSubCategory']['WindowTabData']['DataSet']['DataRow'])
        ) {
            return [];
        }


        // Obtener los registros de productos
        $dataRows = $responseData['EFTU_getProductSubCategory']['WindowTabData']['DataSet']['DataRow'];


        // Asegurar que sea un array de registros
        if (!is_array($dataRows) || isset($dataRows['field'])) {
            $dataRows = [$dataRows]; // Convertir en array si solo hay un elemento
        }

        $categoryData = [];

        foreach ($dataRows as $row) {
            // Validar que 'field' exista y sea un array
            if (!isset($row['field']) || !is_array($row['field'])) {
                continue;
            }

            // Usar Collection para buscar datos más eficientemente
            $fields = collect($row['field'])->mapWithKeys(fn($item) => [$item['@column'] => $item['val']]);

            $categoryData[] = [
                'ID_SubCategory' =>$fields->get('EFTU_RV_ProductSubCategory_ID'),
                'name' =>$fields->get('subcategory_name'),
                'status' =>$fields->get('ecommerce_isactive'),
                'ID_Category'=>$fields->get('EFTU_RV_ProductCategory_ID'),

                
            ];
        }
        return $categoryData;
    }

    public function extractStores($responseData)
    {


        // Verificar si la respuesta ya es un array
        if (!is_array($responseData)) {
            return [];
        }
        // Verificar si existen los datos esperados
        if (
            !isset($responseData['EFTU_getStores']['WindowTabData']['DataSet']['DataRow']) ||
            empty($responseData['EFTU_getStores']['WindowTabData']['DataSet']['DataRow'])
        ) {
            return [];
        }

        // Obtener los registros de productos
        $dataRows = $responseData['EFTU_getStores']['WindowTabData']['DataSet']['DataRow'];


        // Asegurar que sea un array de registros
        if (!is_array($dataRows) || isset($dataRows['field'])) {
            $dataRows = [$dataRows]; // Convertir en array si solo hay un elemento
        }

        $storeData = [];

        foreach ($dataRows as $row) {
            // Validar que 'field' exista y sea un array
            if (!isset($row['field']) || !is_array($row['field'])) {
                continue;
            }

            // Usar Collection para buscar datos más eficientemente
            $fields = collect($row['field'])->mapWithKeys(fn($item) => [$item['@column'] => $item['val']]);

            $storeData[] = [
                'ID_Store' =>$fields->get('EFTU_RV_Stores_ID'),
                'name' =>$fields->get('organization_name'),
                'logo' =>$fields->get('logo'),
                'status' =>$fields->get('ecommerce_isactive')  
            ];
        }
        return $storeData;
    }

    
}
