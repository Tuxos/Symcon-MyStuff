<?

	class HMSonosRemote extends IPSModule {

	public function Create() {

		parent::Create();

		$this->RegisterPropertyInteger("idsonos", "");
		$this->RegisterPropertyString("ipadressccu", "192.168.1.8");
		$this->RegisterPropertyString("serial6t", "NEQ0434752");
		$this->RegisterPropertyString("serialdisplay", "NEQ1593741");
		$this->RegisterPropertyString("zeile1", "Temperatur");
		$this->RegisterPropertyString("zeile2", "Garten");
		$this->RegisterPropertyInteger("idvar", "");
		$this->RegisterPropertyString("postfix", "c");
		$this->RegisterPropertyString("radio1", "1Live");
		$this->RegisterPropertyString("radio2", "Antenne Bayern");
		$this->RegisterPropertyString("radio3", "Bayern 3");

	}

	public function ApplyChanges() {

		parent::ApplyChanges();

		if (($this->ReadPropertyString("serialdisplay") != "") and ($this->ReadPropertyString("ipadressccu") != "") and ($this->ReadPropertyString("idsonos") > 999) and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") > 999))
			{
				$sonosid = $this->ReadPropertyString("idsonos");
				$radio1 = $this->ReadPropertyString("radio1");
				$radio2 = $this->ReadPropertyString("radio2");
				$radio3 = $this->ReadPropertyString("radio3");

				if (@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID) == false) {
					$InsID = IPS_CreateInstance("{5961D2DF-90B1-4B98-A45E-B7717BD383C9}");
					IPS_SetName($InsID, "Display Taster");
					IPS_SetParent($InsID, $this->InstanceID);
				}
				IPS_SetConfiguration(@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID), '{"ipadress":"'.$this->ReadPropertyString("ipadressccu").'","serialnumber":"'.$this->ReadPropertyString("serialdisplay").'"}');
				@IPS_ApplyChanges(@IPS_GetInstanceIDByName("Display Taster", $this->InstanceID));

				if (@IPS_GetInstanceIDByName("6fach Taster", $this->InstanceID) == false) {
					$InsID = IPS_CreateInstance("{4FA0F15F-50A6-451C-8B03-E76A425C2B94}");
					IPS_SetName($InsID, "6fach Taster");
					IPS_SetParent($InsID, $this->InstanceID);
				}
				IPS_SetConfiguration(@IPS_GetInstanceIDByName("6fach Taster", $this->InstanceID), '{"serialnumber":"'.$this->ReadPropertyString("serial6t").'"}');
				@IPS_ApplyChanges(@IPS_GetInstanceIDByName("6fach Taster", $this->InstanceID));

				if (@IPS_GetEventIDByName("when title change", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "when title change");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("when title change", $this->InstanceID), 1, IPS_GetObjectIDByName("Title", $this->ReadPropertyString("idsonos")));
				IPS_SetEventScript(@IPS_GetEventIDByName("when title change", $this->InstanceID), "HMSR_anzeigeTitel($this->InstanceID);");
				IPS_SetEventActive(@IPS_GetEventIDByName("when title change", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("when var change", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "when var change");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("when var change", $this->InstanceID), 1, $this->ReadPropertyString("idvar"));
				IPS_SetEventScript(@IPS_GetEventIDByName("when var change", $this->InstanceID), "HMSR_anzeigePause($this->InstanceID);");
				IPS_SetEventActive(@IPS_GetEventIDByName("when var change", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("when volume change", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "when volume change");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("when volume change", $this->InstanceID), 1, IPS_GetObjectIDByName("GroupVolume", $this->ReadPropertyString("idsonos")));
				IPS_SetEventScript(@IPS_GetEventIDByName("when volume change", $this->InstanceID), "HMSR_anzeigeVolume($this->InstanceID);");
				IPS_SetEventActive(@IPS_GetEventIDByName("when volume change", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste oben links kurz", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste oben links kurz");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste oben links kurz", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_SHORT", IPS_GetObjectIDByName("Taste oben links", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste oben links kurz", $this->InstanceID), "SNS_Pause($sonosid);");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste oben links kurz", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste oben rechts kurz", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste oben rechts kurz");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste oben rechts kurz", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_SHORT", IPS_GetObjectIDByName("Taste oben rechts", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste oben rechts kurz", $this->InstanceID), "SNS_Play($sonosid);");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste oben rechts kurz", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste mitte links kurz", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste mitte links kurz");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste mitte links kurz", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_SHORT", IPS_GetObjectIDByName("Taste mitte links", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste mitte links kurz", $this->InstanceID), "SNS_Previous($sonosid);");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste mitte links kurz", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste mitte rechts kurz", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste mitte rechts kurz");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste mitte rechts kurz", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_SHORT", IPS_GetObjectIDByName("Taste mitte rechts", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste mitte rechts kurz", $this->InstanceID), "SNS_Next($sonosid);");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste mitte rechts kurz", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste unten links kurz", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste unten links kurz");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste unten links kurz", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_SHORT", IPS_GetObjectIDByName("Taste unten links", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste unten links kurz", $this->InstanceID), "SNS_ChangeGroupVolume($sonosid,'-3');");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste unten links kurz", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste unten rechts kurz", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste unten rechts kurz");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste unten rechts kurz", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_SHORT", IPS_GetObjectIDByName("Taste unten rechts", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste unten rechts kurz", $this->InstanceID), "SNS_ChangeGroupVolume($sonosid,'3');");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste unten rechts kurz", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste oben links lang", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste oben links lang");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste oben links lang", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_LONG", IPS_GetObjectIDByName("Taste oben links", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste oben links lang", $this->InstanceID), "SNS_SetRadio($sonosid, $radio1);");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste oben links lang", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste mitte links lang", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste mitte links lang");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste mitte links lang", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_LONG", IPS_GetObjectIDByName("Taste mitte links", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste mitte links lang", $this->InstanceID), "SNS_SetRadio($sonosid, $radio2);");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste mitte links lang", $this->InstanceID), true);

				if (@IPS_GetEventIDByName("6T Taste unten links lang", $this->InstanceID) != true) {
					$eid = IPS_CreateEvent(0);
					IPS_SetParent($eid, $this->InstanceID);
					IPS_SetName($eid, "6T Taste unten links lang");
				}
				IPS_SetEventTrigger(@IPS_GetEventIDByName("6T Taste unten links lang", $this->InstanceID), 0, IPS_GetObjectIDByName("PRESS_LONG", IPS_GetObjectIDByName("Taste unten links", IPS_GetObjectIDByName("6fach Taster", $this->InstanceID))));
				IPS_SetEventScript(@IPS_GetEventIDByName("6T Taste unten links lang", $this->InstanceID), "SNS_SetRadio($sonosid, $radio3);");
				IPS_SetEventActive(@IPS_GetEventIDByName("6T Taste unten links lang", $this->InstanceID), true);


			}

		if (($this->ReadPropertyString("serialdisplay") != "") and ($this->ReadPropertyString("ipadressccu") != "") and ($this->ReadPropertyString("idsonos") != "") and ($this->ReadPropertyString("serial6t") != "") and ($this->ReadPropertyString("idvar") != ""))
			{
				$this->SetStatus(102);
			} else {
				$this->SetStatus(202);
			}

	}

	// Anzeige wenn keine Musik spielt
	public function anzeigePause() {

		$temperatur = GetValue($this->ReadPropertyString("idvar"));
		$displayid = IPS_GetObjectIDByName("Display Taster", $this->InstanceID);
		$titel = GetValue(IPS_GetObjectIDByName("Title", $this->ReadPropertyString("idsonos")));

		if ($titel == "") {
			HMDIS_writeDisplay($displayid, $this->ReadPropertyString("zeile1"), $this->ReadPropertyString("zeile2"), $temperatur.$this->ReadPropertyString("postfix"), "", "", "", "0XF0", "0xC0");
			}

	}

	// Anzeige wenn Lautstärke geändert wird
	public function anzeigeVolume() {

		$displayid = IPS_GetObjectIDByName("Display Taster", $this->InstanceID);
		$volume = GetValue(IPS_GetObjectIDByName("GroupVolume", $this->ReadPropertyString("idsonos")));

		if ($volume != "") {
			HMDIS_writeDisplay($displayid,  "Volume", $volume, " ", "", "", "", "0XF0", "0xC0");
			IPS_Sleep(1500);
			HMSR_anzeigeTitel($this->InstanceID);
		}

	}


	// Anzeige wenn Musik spielt
	public function anzeigeTitel() {

		$temperatur = GetValue($this->ReadPropertyString("idvar"));
		$displayid = IPS_GetObjectIDByName("Display Taster", $this->InstanceID);
		$sonosid =  $this->ReadPropertyString("idsonos");

		$titel = GetValue(IPS_GetObjectIDByName("Title", $sonosid));
		$artist = GetValue(IPS_GetObjectIDByName("Artist", $sonosid));
		$album = GetValue(IPS_GetObjectIDByName("Album", $sonosid));

		$titel1= substr($titel ,0, 12);
		$titel2= substr($titel, 12);

		if ($titel1 == "") $titel1 = " ";
		if (($titel2 == "") && ($album == "")) $titel2 = " ";
		if (($titel2 == "") && ($album != "")) $titel2 = $album;
		if ($artist == "") $artist = " ";

   		if ($titel == "") {
			HMSR_anzeigePause($this->InstanceID);
			} else {
			HMDIS_writeDisplay($displayid, $titel1, $titel2, $artist, "", "", "", "0XF0", "0xC0");
			}

		}

	}
?>
