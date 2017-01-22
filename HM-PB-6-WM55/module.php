<?

	class HMPB6WM55 extends IPSModule {

	public function Create() {

		parent::Create();

		$this->RegisterPropertyString("serialnumber", "");

	}

	public function ApplyChanges() {

		parent::ApplyChanges();

		if (@IPS_GetInstanceIDByName("Taste oben links", $this->InstanceID) == false) {
			$InsID = IPS_CreateInstance("{EE4A81C6-5C90-4DB7-AD2F-F6BBD521412E}");
			IPS_SetName($InsID, "Taste oben links");
			IPS_SetParent($InsID, $this->InstanceID);
		}
		IPS_SetConfiguration(@IPS_GetInstanceIDByName("Taste oben links", $this->InstanceID), '{"Protocol":0,"Address":"'.$this->ReadPropertyString("serialnumber").':1","EmulateStatus":true}');
		@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Taste oben links", $this->InstanceID));

		if (@IPS_GetInstanceIDByName("Taste oben rechts", $this->InstanceID) == false) {
			$InsID = IPS_CreateInstance("{EE4A81C6-5C90-4DB7-AD2F-F6BBD521412E}");
			IPS_SetName($InsID, "Taste oben rechts");
			IPS_SetParent($InsID, $this->InstanceID);
		}
		IPS_SetConfiguration(@IPS_GetInstanceIDByName("Taste oben rechts", $this->InstanceID), '{"Protocol":0,"Address":"'.$this->ReadPropertyString("serialnumber").':2","EmulateStatus":true}');
		@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Taste oben rechts", $this->InstanceID));

		if (@IPS_GetInstanceIDByName("Taste mitte links", $this->InstanceID) == false) {
			$InsID = IPS_CreateInstance("{EE4A81C6-5C90-4DB7-AD2F-F6BBD521412E}");
			IPS_SetName($InsID, "Taste mitte links");
			IPS_SetParent($InsID, $this->InstanceID);
		}
		IPS_SetConfiguration(@IPS_GetInstanceIDByName("Taste mitte links", $this->InstanceID), '{"Protocol":0,"Address":"'.$this->ReadPropertyString("serialnumber").':3","EmulateStatus":true}');
		@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Taste mitte links", $this->InstanceID));

		if (@IPS_GetInstanceIDByName("Taste mitte rechts", $this->InstanceID) == false) {
			$InsID = IPS_CreateInstance("{EE4A81C6-5C90-4DB7-AD2F-F6BBD521412E}");
			IPS_SetName($InsID, "Taste mitte rechts");
			IPS_SetParent($InsID, $this->InstanceID);
		}
		IPS_SetConfiguration(@IPS_GetInstanceIDByName("Taste mitte rechts", $this->InstanceID), '{"Protocol":0,"Address":"'.$this->ReadPropertyString("serialnumber").':4","EmulateStatus":true}');
		@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Taste mitte rechts", $this->InstanceID));

		if (@IPS_GetInstanceIDByName("Taste unten links", $this->InstanceID) == false) {
			$InsID = IPS_CreateInstance("{EE4A81C6-5C90-4DB7-AD2F-F6BBD521412E}");
			IPS_SetName($InsID, "Taste unten links");
			IPS_SetParent($InsID, $this->InstanceID);
		}
		IPS_SetConfiguration(@IPS_GetInstanceIDByName("Taste unten links", $this->InstanceID), '{"Protocol":0,"Address":"'.$this->ReadPropertyString("serialnumber").':5","EmulateStatus":true}');
		@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Taste unten links", $this->InstanceID));

		if (@IPS_GetInstanceIDByName("Taste unten rechts", $this->InstanceID) == false) {
			$InsID = IPS_CreateInstance("{EE4A81C6-5C90-4DB7-AD2F-F6BBD521412E}");
			IPS_SetName($InsID, "Taste unten rechts");
			IPS_SetParent($InsID, $this->InstanceID);
		}
		IPS_SetConfiguration(@IPS_GetInstanceIDByName("Taste unten rechts", $this->InstanceID), '{"Protocol":0,"Address":"'.$this->ReadPropertyString("serialnumber").':6","EmulateStatus":true}');
		@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Taste unten rechts", $this->InstanceID));



		if ($this->ReadPropertyString("serialnumber") != "")
			{
				$this->SetStatus(102);
			} else {
				$this->SetStatus(202);
			}

	}
	}
?>
