

This is a test function:

<?php

public function getLastVisitByBrowser($idSite, $period, $date, $segment = false)
{
	$data = \piwik\piwik\Live\API::getInstance()->getLastVisitsDetails(
		$idSite,
		$period,
		$date,
		$segment,
		$numLastVisitorToFetch = 100,
		$minTimestamo = false,
		$flat = false,
		$doNotFetchAction = true
	);
	
	//?????
	$data->applyQueueFilters();
	
	//?????
	$result = $data->getEmptyClone($keepFilter = false);
	
	foreach($data->getRows() as $visitRow){
		//Browser name
		$browserName = $visitRow->getColumn('browserName');
		
		$resultRowForBrowser = $result->getRowFromLabel($browserName);
		
		if($resultRowForbrowser === false){
			//???addRowFromSimpleArray
			$result->addRowFromSimpleArray(array(
				'label' => $browserName,
				'nb_visits' => 1
			));
		}else{
			//setColumn
			$resultRowForBrowser->SetColumn('nb_visits', $resultRowForBrowser->getColumn(''nb_visits)+1);
		}
	}
	return $result;
}



/report/GetMyTestPlugin.php

public function configureView(ViewDataTable $view)
{
	//????
	$view->config->show_table_all_columns = false;
	$view->config->addTranslation('label', 'Browser');
	//???config->conlumns_to_display
	$view->config->conlumns_to_display =  array_merge(array('label')),

}

/////////////////////////////part3////////////////

<?php

namespace Piwik\Plugins\MyPlusin;

class Settings extends \Piwik\Plugin\Settings
{
	//????
	public $realtimeReportDimension;
	
	protected function init()
	{
		//???? createRealtimeReportDimensionSetting()
		$this->realtimeReportDimension = $this->createRealtimeReportDimensionSetting();
		$this->addSetting($this->realtimeReportDimension);
	}

	private function createRealtimeReportDimensionSetting()
	{
		$setting = new\piwik\Settings\UserSetting('reportDimension','Report Dimension');
		$setting->type = self::TYPE_STRING;
		$setting->uiCountrolType = self::CONTROL_SINGLE_SELECT;
		$setting->description = 'Choose the dimension to aggregate by';
		$setting->availableValues =  MyPlugin::$availableDimensionsForAggregation;
		$setting->defaultValue = 'browserName';
		
		return $setting;
	}
}

public static $availableDimensionsForAggregation = array(
    'browserName' => 'Browser',
    'visitIp' => 'IP',
    'visitorId' => 'Visitor ID',
    'searches' => 'Number of Site Searches',
    'events' => 'Number of Events',
    'actions' => 'Number of Actions',
    'visitDurationPretty' => 'Visit Duration',
    'country' => 'Country',
    'region' => 'Region',
    'city' => 'City',
    'operatingSystem' => 'Operating System',
    'screenType' => 'Screen Type',
    'resolution' => 'Resolution'

    // we could add more, but let's not waste time.
);



