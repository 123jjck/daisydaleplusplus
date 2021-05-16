<?php
session_start();
if(!isset($_SESSION['userId'])) exit;

require("db_connection.php");

function rc4($key_str, $data_str)
{
    // convert input string(s) to array(s)
    $key = array();
    $data = array();
    for ($i = 0;$i < strlen($key_str);$i++)
    {
        $key[] = ord($key_str[$i]);
    }
    for ($i = 0;$i < strlen($data_str);$i++)
    {
        $data[] = ord($data_str[$i]);
    }
    // prepare key
    $state = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 154, 155, 156, 157, 158, 159, 160, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 180, 181, 182, 183, 184, 185, 186, 187, 188, 189, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215, 216, 217, 218, 219, 220, 221, 222, 223, 224, 225, 226, 227, 228, 229, 230, 231, 232, 233, 234, 235, 236, 237, 238, 239, 240, 241, 242, 243, 244, 245, 246, 247, 248, 249, 250, 251, 252, 253, 254, 255);
    $len = count($key);
    $index1 = $index2 = 0;
    for ($counter = 0;$counter < 256;$counter++)
    {
        $index2 = ($key[$index1] + $state[$counter] + $index2) % 256;
        $tmp = $state[$counter];
        $state[$counter] = $state[$index2];
        $state[$index2] = $tmp;
        $index1 = ($index1 + 1) % $len;
    }
    // rc4
    $len = count($data);
    $x = $y = 0;
    for ($counter = 0;$counter < $len;$counter++)
    {
        $x = ($x + 1) % 256;
        $y = ($state[$x] + $y) % 256;
        $tmp = $state[$x];
        $state[$x] = $state[$y];
        $state[$y] = $tmp;
        $data[$counter] ^= $state[($state[$x] + $state[$y]) % 256];
    }
    // convert output back to a string
    $data_str = "";
    for ($i = 0;$i < $len;$i++)
    {
        $data_str .= chr($data[$i]);
    }
    return $data_str;
}
function encrypt($str)
{
    return bin2hex(rc4("_level0", $str));
}

$config = '<config><item Id="1" Parameter="AccessRoleFlags" Value="0" Type="number" /><item Id="3" Parameter="IsPreloaderFast" Value="0" Type="bool" /><item Id="4" Parameter="InitialVolumeValue" Value="0" Type="number" /><item Id="6" Parameter="IsPreloaderEnabled" Value="1" Type="bool" /><item Id="7" Parameter="IsStartupHomeLocation" Value="0" Type="bool" /><item Id="8" Parameter="SwfVersion" Value="" Type="string" /><item Id="9" Parameter="SynchronizeAvatarRotation" Value="1" Type="bool" /><item Id="10" Parameter="StatisticsSendInterval" Value="0" Type="number" /><item Id="12" Parameter="LanguageId" Value="1" Type="number" /><item Id="13" Parameter="SnId" Value="1" Type="number" /><item Id="14" Parameter="IsInternational" Value="0" Type="bool" /><item Id="15" Parameter="AutoServerSelectionAllowed" Value="1" Type="bool" /><item Id="16" Parameter="DaysToFullSoil" Value="28" Type="number" /><item Id="17" Parameter="DaysToHalfSoil" Value="14" Type="number" /><item Id="18" Parameter="CurrentQuest" Value="467" Type="number" /><item Id="20" Parameter="TypeWeapon" Value="0" Type="number" /><item Id="21" Parameter="SkipTutorial" Value="1" Type="bool" /><item Id="23" Parameter="CurrentQuestGroup" Value="1000" Type="string" /><item Id="24" Parameter="IsNewRegistration" Value="1" Type="bool" /><item Id="25" Parameter="IsMotivatingAdsOn" Value="1" Type="bool"/><item Id="26" Parameter="VersionMode" Value="2" Type="number" /></config>';

$domain = (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) ? 'localhost' : $_SERVER["SERVER_ADDR"];
$serversList = '<servers><item Id="1" TRId="1" RId="5" RTMPUrl="rtmp://' . $domain . ':1935/daisy" Load="0" QuestLocationLoad="0" FriendsCount="1" ClubsCount="5" Weight="0" /></servers>';

$query = $dbh->prepare("SELECT * FROM users WHERE ID = :id");
$query->bindParam('id', $_SESSION['userId']);
$query->execute();
$fetched = $query->fetch(PDO::FETCH_ASSOC);

$ud = "";
if ($fetched['ISBANNED'] == 1)
{
    $ud = 'BanDateExpired="31-12-9999 23:59:59" BanTextResourceID="162"';
}

$userData = '<user UserId="' . $_SESSION["userId"] . '" hwId="' . $_SESSION["ticket"] . '" ticketId="' . $_SESSION["ticket"] . '" RoleFlags="' . $fetched["ROLEFLAGS"] . '" ' . $ud . '  />';
$system = '<system ServerDate="' . date('Y-m-d H:i:s') . '" RPath="fs/3p897j5lf4e0j.swf" RVersion="49" />';

echo '<?xml version="1.0" encoding="utf-8"?>
<response>
    <promotion>
        <i MRId="20106" State="1" />
        <i MRId="30896" State="7" />
    </promotion>
    <promotion_banner>
        <i MRId="30896" />
    </promotion_banner>
    <promotion_whats_new>
        <i Id="386" TypeId="1" MRId="20143" />
        <i Id="611" TypeId="2" MRId="27179" />
        <i Id="784" TypeId="2" MRId="30841" />
        <i Id="785" TypeId="2" MRId="30895" />
        <i Id="786" TypeId="2" MRId="30897" />
    </promotion_whats_new>
    <preloader>
        <i MRId="30894" ShowTime="20;00" />
    </preloader>
    <sn_status IsBinded="1" />
    <phone>
        <messages/>
    </phone>
    <user_name Value="' . $fetched['USERNAME'] . '" />
    <postcard>
        <messages/>
    </postcard>
    <licence_promotion>
        <item Id="1" GroupId="0" OrderId="0" MRId="14763" />
        <item Id="2" GroupId="0" OrderId="1" MRId="14764" />
        <item Id="3" GroupId="0" OrderId="2" MRId="14765" />
        <item Id="4" GroupId="1" OrderId="0" MRId="14766" />
        <item Id="5" GroupId="1" OrderId="1" MRId="14767" />
        <item Id="6" GroupId="1" OrderId="2" MRId="14768" />
        <item Id="7" GroupId="2" OrderId="0" MRId="20597" />
        <item Id="8" GroupId="2" OrderId="1" MRId="20598" />
        <item Id="9" GroupId="2" OrderId="2" MRId="20599" />
    </licence_promotion>
    <flags EntranceCount="2600" IsUserDetailsMissing="1" />
    <tutorial>
        <item Id="-1" State="1" />
        <item Id="1" State="1" />
        <item Id="2" State="1" />
        <item Id="3" State="1" />
        <item Id="4" State="1" />
        <item Id="5" State="1" />
    </tutorial>
    <miniquest>
    </miniquest>
    <grants ReceivingCount="0" />
    <requests ReceivingCount="0" />
    <cdata value="' . encrypt($config) . '" />
    <cdata value="' . encrypt($system) . '" />
    <cdata value="' . encrypt($userData) . '" />
    <cdata value="' . encrypt($serversList) . '" />
</response>';
