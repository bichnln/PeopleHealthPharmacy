<?php 
    require_once("report.php");
    require_once ("../../vendor/autoload.php");
    use Phpml\Regression\LeastSquares;

    function itemWeekPrediction($week) {
        $dataOf = array();

        $projectedData = array(array());
        array_pop($projectedData);
        $itemList = array();
        array_pop($itemList);
        // get all items from inventory
        $itemList = getAllItems();
       
        // put sales in weeks of items into associative array
        foreach ($itemList as $item) {
            $weeklyRecords = getOneItemWeekly($item['itemName']);
            for ($i = 0; $i < count($weeklyRecords); $i++) {
                $dataOf[$item['itemName']][$i] =  $weeklyRecords[$i];
            }
        }
        
        $samples = array();     // all sales data
        $targets = array();     // months/weeks

        // get all data from different weeks/month of an item 
        foreach ($itemList as $item) {
            $samples[$item['itemName']] = array();
            $targets[$item['itemName']] = array();
    

            for ($i = 1 ; $i < count($dataOf[$item['itemName']]); $i++) {
                
                // because samples 's data are arrays
                $array = array();
                array_pop($array);
                array_push($array, $dataOf[$item['itemName']][$i]['Week']);

                array_push($samples[$item['itemName']], $array);
                array_push($targets[$item['itemName']], $dataOf[$item['itemName']][$i]['TotalQuantity']);
            }
        }
   
        foreach ($itemList as $item) {         
            $itemName = $item['itemName'];
            
            // can only predict sales for items having more than 2 monthly or weekly records
            if (count($samples[$itemName]) > 1) {       

              //  print_r($samples[$itemName]);
               // print_r("\n");
                $regression = new LeastSquares();
                $regression->train($samples[$itemName], $targets[$itemName]);
    
                $toArray = array();
                array_push($toArray, $week);
                
                $temp = array();
                $temp['itemName'] = $item['itemName'];
                $temp['projectedSales'] = $regression->predict($toArray);
                $temp['week'] = $week;
                
                array_push($projectedData, $temp);
                
                unset($temp);
                unset($regression);
            }
        }
                
        print_r($projectedData);
        return $projectedData;
    }

    function itemMonthPrediction($month) {
        $dataOf = array();

        $projectedData = array(array());
        array_pop($projectedData);
        $itemList = array();
        array_pop($itemList);
        // get all items from inventory
        $itemList = getAllItems();
       
        // put sales in weeks of items into associative array
        foreach ($itemList as $item) {
            $monthlyRecords = getOneItemMonthly($item['itemName']);
            for ($i = 1; $i < count($monthlyRecords); $i++) {
                $dataOf[$item['itemName']][$i] =  $monthlyRecords[$i];
            }
        }
        
        echo "<p>Month Item: </p>";
       // print_r($dataOf);
        $samples = array();     // all sales data
        $targets = array();     // months/weeks

        // get all data from different weeks/month of an item 
        foreach ($itemList as $item) {
            $samples[$item['itemName']] = array();
            $targets[$item['itemName']] = array();
    
            if (array_key_exists($item['itemName'], $dataOf)) {
                for ($i = 1 ; $i <= count($dataOf[$item['itemName']]); $i++) {
                
                    // because samples 's data are arrays
                    $array = array();
                    array_pop($array);
                    array_push($array, $dataOf[$item['itemName']][$i]['Month']);
    
                    array_push($samples[$item['itemName']], $array);
                    array_push($targets[$item['itemName']], $dataOf[$item['itemName']][$i]['TotalQuantity']);
                }
            }
        }
        
        foreach ($itemList as $item) {         
            $itemName = $item['itemName'];
            
            if (array_key_exists($itemName, $samples)) {
                
                if (count($samples[$itemName]) > 1) {       

                    $regression = new LeastSquares();
                    $regression->train($samples[$itemName], $targets[$itemName]);
        
                    $toArray = array();
                    array_push($toArray, $month);
                    
                    $temp = array();
                    $temp['itemName'] = $item['itemName'];
                    $temp['projectedSales'] = $regression->predict($toArray);
                    $temp['month'] = $month;
                    
                    array_push($projectedData, $temp);
                    
                    unset($temp);
                    unset($regression);
                } 
            }
        }

        return $projectedData;  
    }
    
    function categoryWeekPrediction($week) {
        $dataOf = array();

        $projectedData = array(array());
        array_pop($projectedData);
        $categories = array();
        array_pop($categories);
        // get all items from inventory
        $categories = getAllCategories();
       
        // put sales in weeks of items into associative array
        foreach ($categories as $cat) {
            $weeklyRecords = getOneCategoryWeekly($cat['category']);
            for ($i = 1; $i < count($weeklyRecords); $i++) {
                $dataOf[$cat['category']][$i] =  $weeklyRecords[$i];
            }
        }
        
        echo "<p>Month category: </p>";
       // print_r($dataOf);
        $samples = array();     // all sales data
        $targets = array();     // months/weeks

        // get all data from different weeks/month of an item 
        foreach ($categories as $cat) {
            $samples[$cat['category']] = array();
            $targets[$cat['category']] = array();
    
            if (array_key_exists($cat['category'], $dataOf)) {
                for ($i = 1 ; $i <= count($dataOf[$cat['category']]); $i++) {
                
                    // because samples 's data are arrays
                    $array = array();
                    array_pop($array);
                    array_push($array, $dataOf[$cat['category']][$i]['Week']);
    
                    array_push($samples[$cat['category']], $array);
                    array_push($targets[$cat['category']], $dataOf[$cat['category']][$i]['TotalQuantity']);
                }
            }
        }
        
        foreach ($categories as $cat) {         
            $category = $cat['category'];
            
            if (array_key_exists($category, $samples)) {
                
                if (count($samples[$category]) > 1) {       

                    $regression = new LeastSquares();
                    $regression->train($samples[$category], $targets[$category]);
        
                    $toArray = array();
                    array_push($toArray, $week);
                    
                    $temp = array();
                    $temp['category'] = $cat['category'];
                    $temp['projectedSales'] = $regression->predict($toArray);
                    $temp['week'] = $week;
                    
                    array_push($projectedData, $temp);
                    
                    unset($temp);
                    unset($regression);
                } 
            }
        }

        return $projectedData;  
    }

    function categoryMonthPrediction($month) {
        $dataOf = array();

        $projectedData = array(array());
        array_pop($projectedData);
        $categories = array();
        array_pop($categories);
        // get all items from inventory
        $categories = getAllCategories();
       
        // put sales in weeks of items into associative array
        foreach ($categories as $cat) {
            $monthlyRecords = getOneCategoryMonthly($cat['category']);
            for ($i = 1; $i < count($monthlyRecords); $i++) {
                $dataOf[$cat['category']][$i] =  $monthlyRecords[$i];
            }
        }
        
        echo "<p>Month category: </p>";
       // print_r($dataOf);
        $samples = array();     // all sales data
        $targets = array();     // months/weeks

        // get all data from different weeks/month of an item 
        foreach ($categories as $cat) {
            $samples[$cat['category']] = array();
            $targets[$cat['category']] = array();
    
            if (array_key_exists($cat['category'], $dataOf)) {
                for ($i = 1 ; $i <= count($dataOf[$cat['category']]); $i++) {
                
                    // because samples 's data are arrays
                    $array = array();
                    array_pop($array);
                    array_push($array, $dataOf[$cat['category']][$i]['Month']);
    
                    array_push($samples[$cat['category']], $array);
                    array_push($targets[$cat['category']], $dataOf[$cat['category']][$i]['TotalQuantity']);
                }
            }
        }
        
        foreach ($categories as $cat) {         
            $category = $cat['category'];
            
            if (array_key_exists($category, $samples)) {
                
                if (count($samples[$category]) > 1) {       

                    $regression = new LeastSquares();
                    $regression->train($samples[$category], $targets[$category]);
        
                    $toArray = array();
                    array_push($toArray, $month);
                    
                    $temp = array();
                    $temp['category'] = $cat['category'];
                    $temp['projectedSales'] = $regression->predict($toArray);
                    $temp['month'] = $month;
                    
                    array_push($projectedData, $temp);
                    
                    unset($temp);
                    unset($regression);
                } 
            }
        }

        return $projectedData;  
    }
    
    

    

?>


