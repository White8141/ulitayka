<?php
/**
 * Created by PhpStorm.
 * User: White
 * Date: 01.02.2018
 * Time: 12:48
 */

namespace App\InsuranceAPI\Vsk;

/**
 * Содержит массив со странами и их id для альфастраха
 */
class VskDirect
{
    private static $vskCountriesList = [
        'SCHENGEN' => 'cc6831c0-84ff-4800-a748-c5cfaf9885bb',
        'AFGANISTAN' => '2359394c-1535-4103-9af3-a48304ef3799',
        'AFRICA' => '846fe4cf-06cc-44f0-98d3-b37ea2354e09',
        'MAURITIUS' => 'e6e5d83e-1d90-43d7-a703-672a3e84e034',
        'MOZAMBIQUE' => 'e8b2854a-ba2c-400c-bc2c-9dc704cae08d',
        'ALBANIA' => '8917158d-f25f-4dc2-9a99-5873f750e686',
        'ALGERIA' => '7432db36-2266-4c63-b533-0c071d6422e1',
        'ANDORRA' => 'af021c01-7dd4-4ab6-ba51-d4904da57a26',
        'ARGENTINA' => 'f7f16d49-da25-42db-8e9e-316ab6bc385a',
        'ARGENTINA, BRAZIL, CHILE' => '61d77342-0254-4b45-a2dd-152e2dc37c06',
        'AUSTRALIA' => '5145901f-0063-4520-aa1d-74a9f82a38f2',
        'AUSTRIA' => '63917206-69bb-4f5e-a71b-6931c5710438',
        'BAHAMAS' => '6214fc94-613d-4174-a95c-c6fe4f7f7ee5',
        'BAHRAIN' => 'c29354b0-19b1-41df-bb6f-3a2dff13cd11',
        'BALI' => 'e2bc1132-d926-476c-9d33-416dd3bb2e98',
        'BANGKOK, BALI' => '94eb8485-294e-45dc-b505-c3317c180e1d',
        'BANGLADESH' => '395af68d-b927-4ef9-b6d4-c2fbc8d70d6f',
        'BARBADOS' => '59292c42-58ff-4c28-89bb-3a0fa509aba3',
        'BELGIUM' => '884e4309-56f3-42e8-a973-245a45208856',
        'BERMUDAS' => 'fb32e17f-c3f6-4e72-8b80-c7d574a1737c',
        'BOLIVIA' => '1f223568-51a3-4156-80d2-c852dd00798e',
        'BOSNIA' => '7c56a786-a813-4464-9fbd-0d2b079a3f72',
        'BRAZIL' => '5f183ad4-7761-4bbf-9576-5878cb3c69cd',
        'BULGARIA' => '1ea86899-6933-49f5-a128-de74f1ade505',
        'CAMBODIA' => '05c78cb4-df49-4759-bd4e-4fef87c04785',
        'CANADA' => '0a41630d-09a8-4aff-960b-3b1708eba62a',
        'CARIBIAN ' => '64116f6c-ba66-40ae-a614-0c9a952f23ca',
        'CHAD' => 'b30a2c9c-403d-4ff9-9559-db2a9e34450b',
        'CHILI' => '0b54406e-d0aa-4e9f-8e8d-0b8fb50f6724',
        'CHINA' => '4d574781-343f-479d-8d4b-e18320c68cdd',
        'COLOMBIA' => '37e5d86e-20d1-4a8f-8671-66cd8c124971',
        'CONGO' => '2edf5910-b180-4777-917c-3ee13ec7af75',
        'COSTA RICA' => '5955212a-e3ed-4102-91a4-14f5afd599e4',
        'COTE D`IVOIRE' => '72a69ca8-db76-4659-9b0f-045e1a458228',
        'CROATIA' => 'a4a68b61-ca63-40c9-bcbc-ab25c45a0067',
        'CUBA' => '890612f0-0065-4db2-ae6e-7a3a4f1e9adf',
        'CYPRUS' => 'aeaec25a-2c95-4645-bed7-5eae5b41610b',
        'CZECH REPUBLIC' => '2d108b93-25cb-42bb-b472-802b0fd1baa3',
        'DENMARK' => '9e3bfd46-72fb-4696-8581-5c8a989ecd30',
        'DOMINICAN' => '42b0441e-997f-4d64-8d85-3e21c0b55dda',
        'EAST TIMOR' => '050e296e-d178-4bf1-a471-38e910786133',
        'ECUADOR' => 'd958f6cf-e10d-4ba8-bddc-8c48340b6c43',
        'EGYPT' => '11dcde12-3506-4b8d-a410-28a1725b9b52',
        'ESTONIA' => '530bf507-745a-4292-a944-641dfbf51450',
        'EUROPE' => 'cce4e55a-7a84-4de1-be98-4326cd5da4c4',
        'FALKLAND ISLANDS' => 'e6fed6fc-0d15-4df5-a872-8cb86000272f',
        'FIDJI' => '4edbdb18-b22d-485b-8209-0b0a97b26779',
        'FINLAND' => 'a9164115-39ba-4a5d-8c84-fcdc7bc6357b',
        'FRANCE' => 'c32afc5e-61ac-4059-abac-d8964f3fc72a',
        //'GEORGIA' => '8a3f47c6-ee11-4e13-b6e6-8265f75f4f0c',
        'GERMANY' => '8eba00ab-d62f-4e4c-8878-6ba5aa1127e6',
        'GHANA' => '9724e98a-f7ee-4b16-b49f-ec7a18c6d775',
        'BRITAIN' => '04218919-d34f-45c6-9e75-314ba52a5564',
        'GREECE' => '8b472a1c-e818-458e-a7c9-8614e3dcc5d9',
        'GUAM' => '74d30ed6-34db-48b2-bf76-9a9d3df90402',
        'GUYANA' => '04f47788-e7b3-4ff7-bf67-6b3be8f89c4e',
        'HAITI' => '01cada6d-8f64-46d3-b643-5e1a550310c3',
        'HOLLAND' => '64112946-0e24-4795-9133-33e94f1a281e',
        'HONDURAS' => '03691bc7-6f19-416d-846f-ab264c85a1fd',
        'HONG-KONG' => '4b5bfca6-0e9e-4386-9890-a6ce1bcf1719',
        'HUNGARY' => '2af7bfa5-8f6d-47e2-b403-fb43df2e7116',
        'ICELAND' => '38a82280-24ce-4dd3-a1f3-52fba0d9c726',
        'INDIA' => 'b3ed9ea9-fec7-43d2-9c2a-dbd54ecf3357',
        'INDONESIA' => 'e40b6610-af6e-423a-ba5d-52f3d90465e1',
        'IRAN' => '8f13227a-02b9-4791-bf6f-d33ab5d293ce',
        'IRAQ' => '6f1f1833-e471-4746-83f6-c0d6a1e6d7f4',
        'IRELAND' => 'e659ba92-c9be-47d9-b399-82c811cda40c',
        'ISRAEL' => 'bd2773a2-8d60-4e36-aaf6-b34ef95f72be',
        'ITALY' => 'c871a6e0-cdf9-403c-b849-82894261b0df',
        'JAMAICA' => '6b7db438-423a-4334-9d9e-98b002817d8b',
        'JAPAN' => '73322baf-8140-44b8-ab9b-6fbbc72951e7',
        'JORDAN' => 'f6a869db-12c1-417a-b0bc-891dee8bb3a5',
        'KENYA' => '64c3baa2-71d6-405c-8039-8bb253735efa',
        'KOREA' => '56eef5d4-a28b-45f4-9c63-7fe5c4833cff',
        'KUWAIT' => '9ca4ce25-7774-4ae4-8a11-20c1e10a7fbb',
        'LAOS' => '4fea2f50-2aa7-44a0-9e15-df73ac30d4a6',
        'LATVIA' => '7c0fda76-1620-47ee-9e2f-a2d78a111ad3',
        'LEBANON' => '60464242-dd35-4f10-9135-b540b6fcd0b4',
        'LIBERIA' => '4ac0b297-d832-4e7f-b605-aa4966f3adae',
        'LIBYA' => '2eeb7446-2134-4c3c-a189-6cc378b70a34',
        'LITHUANIA' => '11e4d75c-79ee-4451-b545-13db2752367b',
        'LUXEMBURG' => '42c62318-c1b4-44df-932b-346783f16c0d',
        'MACEDONIA' => '0e794745-a079-4070-9ce1-93d89ef4dc7c',
        'MADAGASKAR' => '331748f6-13ea-4e7a-a6a9-06ed133a4f69',
        'MALAYSIA' => '6ab7c28f-2b03-4024-bbda-808775c5ec7b',
        'MALDIVES' => '408afe88-8c0b-422c-aed0-ba5bb87d9d6c',
        'MALTA' => 'de7259da-13cd-4807-9d26-200ad0ceb0c6',
        'MAROCCO' => 'da1f6c6c-45e4-44db-810a-4aae0677d3bb',
        'MARTINIQUE' => '11c39574-9cfc-4334-a4fa-7a72a6ea6ce5',
        'MAURITIUS' => 'bbd2a895-3aa0-4daa-9908-1832177bb6ba',
        'MEXICO' => 'bce28861-20fe-4cce-b0a5-f9c5d8bcf696',
        'MONACO' => 'fc8a5391-3df8-43af-b7b4-9490898f5645',
        'MONGOLIA' => 'c5addb2d-6b65-478e-af31-d68c7128ca87',
        'MONTENEGRO' => '269861b3-88c2-42bb-a683-c6ce336a5a87',
        'MOZAMBIQUE' => 'e0f51668-6835-48c2-88f1-80269f7f75c4',
        'MYANMAR' => '792729ac-0bed-47c1-a854-9db51144de41',
        'NEPAL' => 'd7e24871-1d25-4cc8-87ef-bcfe1c351256',
        'NETHERLANDS' => '70401d1d-3d9f-4b52-b618-59c3c2f081e0',
        'ZEALAND' => 'eaa2769f-546c-44c4-b171-02a97e0b062a',
        'NICARAGUA' => 'bf85082b-fca6-4a5a-9281-7f4093127880',
        'NIGERIA' => 'fd1cf434-6f36-41be-bff3-d56bda623eda',
        'NORTH KOREA ' => 'b5535824-b658-4d57-8f78-c8fd1066b962',
        'NORWAY' => '63cbcd01-a3e4-41fa-a1f3-4d18cfc5d070',
        'OMAN' => '0552c665-beaf-47e0-9928-94fc4f628b5e',
        'PAKISTAN' => '2855db94-01a7-4a6b-b8e5-b1467a79f5c4',
        'PAPUA NG' => 'ccef0bd7-ad45-43b8-a252-b0bafaa41766',
        'PERU' => 'bd75aae7-b90b-40a0-819e-42e2683203db',
        'PHILIPPINES' => 'a3ad1edc-18b3-43b0-bb9c-a6e353ca15f0',
        'POLAND' => 'fa26302b-1f59-447b-987a-f54f0087550c',
        'PORTUGAL' => 'b09e34b4-cda3-4f2b-ae49-91b026696082',
        'QATAR' => '93b3b0bf-d020-4d13-bfba-ec087266ad65',
        'ROMANIA' => '3b5d6cc6-53f1-41f7-8cbb-f76b1517f1da',
        'SAUDI ARABIA' => '3d2b60d9-29f3-4c0a-880c-5c7dfbd1053a',
        'SCOTLAND' => 'ff991560-ae11-4f44-9186-d3531356b864',
        'SERBIA' => '6eafef7f-d8a0-4834-bc3a-bc72f3c519e8',
        'SEYCHELLES' => 'd67b50ae-ff71-4369-a959-b033774fc63d',
        'SIERRA LEONE' => '32069ea0-17bd-4d55-a31d-aa54fe95b756',
        'SINGAPORE' => '3031d975-1170-4b6f-9708-a50eee9d5fb2',
        'SLOVAKIA' => '50dd7145-4b61-4e3b-986a-22f5d068c6ec',
        'SLOVENIA' => '1cbe1f73-d264-404f-a1c2-a56345606011',
        'SOUTH AFRICA' => '758cccf8-9bdf-4ac7-b47c-9fd4d3e293da',
        'SOUTH KOREA' => 'e2549818-ed31-4266-9e16-4aa0382b7f3c',
        'SPAIN' => '6bd6a8df-e15d-4dea-b9af-422109569380',
        'SRI LANKA' => 'cdec33e8-890c-4820-b7b1-d744d8163d41',
        'SUDAN' => '611ed367-dd07-4b30-a38e-4e0b6651eeb6',
        'SWEDEN' => '74760efc-5c14-4362-8ae1-e9e55ba96817',
        'SWITZERLAND' => '92428504-b70f-4f06-a3f3-cd5d18e6e853',
        'TAIWAN' => '08350311-9299-4bd6-b9b7-23156300f1a0',
        'TANZANIA' => '5ef0de48-a624-46ae-834d-1f2403124c01',
        'THAILAND' => '3ee4e501-99d8-4b0d-ae76-6072094dab51',
        'TIMOR' => '4872d7c4-6f58-4d7c-a864-5e979d33ed6e',
        'TUNISIA' => 'ab1fb664-c363-4572-b31a-f22e0809ddf4',
        'TURKEY' => '0c8fa6c3-5b1e-4301-b09f-0832362a0a6a',
        'UAE' => '03697d53-1add-499b-9757-07ccfcef5a59',
        'UGANDA' => 'e6257a43-0615-4aee-ba82-09831a0b599b',
        'URUGUAY' => 'd745893b-5e72-44e1-9117-7fae85902d98',
        'USA' => '568f560f-2de3-4a5d-a733-ea0fa20c2813',
        'VENEZUELA' => 'b21c92dc-7ab2-4ae4-8643-33f064c77365',
        'VIETNAM' => '9a12524e-0c2e-471a-a7eb-66bb0f0676c5',
        'WESTERN SAHARA' => '4419ddb7-79bb-464f-a72b-11608c5fc598',
        'YEMEN' => '4da766bd-ab6d-42f7-a7ec-d88ffbc9b359',
        'ZIMBABWE' => 'd5eec2a8-d479-45c7-a51f-deaf37db66d8'
    ];

    private static $vskCountriesRusList = [
        'UKRAINE' => 'd4f3dc2d-fcde-4931-9dc5-7e5e80a8a06e',
    	'ABKHAZIA' => '4a389b43-ed0c-4bcc-a669-1060c3cfe5f0',
    	'AZERBAIJAN' => 'd4984093-1ae9-42d5-b45a-dfb466f72bb2',
    	'ARMENIA' => 'f136f7dd-bc6b-4889-a886-ce3ff96c4f96',
    	'BELORUSSIA' => '87277ca4-744d-49fd-8bd4-f3a1ad73cfa3',
    	'GEORGIA' => 'ec9acd24-9849-46b0-9d24-f5720dc31a2f',
    	'KAZAKHSTAN' => '88a40d52-852a-4eba-bed7-b195ec93090e',
    	'KYRGYZSTAN' => '2fb3063d-1e50-4028-a842-dd3b3d148343',
    	'MOLDOVA' => '57bd671c-33e1-46e8-9fdf-1895bc905f86',
    	'RUSSIA' => '001b99b3-f417-4837-9f2f-36c7948efde2',
    	'TADJIKISTAN' => '9b6bd196-5a00-4962-93c7-b7e08bbcbc79',
    	'TURKMENISTAN' => 'c5b2b281-0c17-40c9-87bf-ef3b3da566a4',
    	'UZBEKISTAN' => '8b1307d8-d2b6-43c0-996a-f6bba8419ff9'
    	//'ЮЖНАЯ ОСЕТИЯ' => '257d703f-5e06-4119-99f5-debcf3d8997d'

    ];

    private static $vskRisksList = [
        'medical' => '8d98d27c-3202-492e-81ba-d5fe6f0bbc7c',
        'public' => '5ec2725f-7134-4e6b-930f-3d24000d880b',
        'cancel' => '303a03ef-5a6e-45e1-8b3d-14cf1a863144',
        'accident' => 'df4a2e06-b1d9-4dd4-a378-28af663170c4',
        'property' => '6c37f82b-82a0-4ceb-8af6-d7f3e8c752f3',
        'laggage' => 'e59c61cd-f79b-4465-80da-d2a3bba712bf',
        'anti-tick' => 'd15be83e-8752-444b-a444-34dee53f7c4d',
        'transporting' => 'abd08c2d-d531-469a-97ea-91306ce98ca7'
    ];

    private static $vskRisksVariantList = [
        'medical' => [ 'en' => '32a23bb9-5c95-4c79-9a04-9c5d07b3a22a', 'rus' => 'fa7b4572-9faf-4fba-a5f6-ad0fba59fe5e'],
        'public' => [ 'en' => '', 'rus' => 'fa7b4572-9faf-4fba-a5f6-ad0fba59fe5e'],
        'cancel' => [ 'en' => '1ac2cd41-2a8e-4b8b-b77f-8e83fb511c38', 'rus' => '460c68f9-1218-43dd-a323-a9d366951bfa'],
        'accident' => [ 'en' => '', 'rus' => ''],
        'property' => [ 'en' => '', 'rus' => ''],
        'laggage' => [ 'en' => '', 'rus' => ''],
        'anti-tick' => [ 'en' => '32a23bb9-5c95-4c79-9a04-9c5d07b3a22a', 'rus' => 'fa7b4572-9faf-4fba-a5f6-ad0fba59fe5e'],
        'transporting' => [ 'en' => '', 'rus' => '']
    ];

    private static $vskAdditionalConditions = [
        'leisure' => '06cae2f2-49cf-4045-85a6-abe95ef650e1',
        'competition' => '1c3021d0-305b-4233-91e2-92c1f695e51a',
        'extreme' => 'bbea6fd7-020e-44de-97ff-64f8804afaaa'
    ];

    public static function getCountryUID($country)
    {
        if (isset(self::$vskCountriesList[$country])) {
            return self::$vskCountriesList[$country];
        } else {
            if (isset(self::$vskCountriesRusList[$country])) {
                return self::$vskCountriesRusList[$country];
            } else { return null; }
        }

    }

    public static function getRiskUID($risk)
    {
        return self::$vskRisksList[$risk] ?? null;
    }

    public static function getRiskVariantUID($risk, $country)
    {
        if (isset(self::$vskCountriesList[$country])) {
            return self::$vskRisksVariantList[$risk]['en'];
        } else {
            if (isset(self::$vskCountriesRusList[$country])) {
                return self::$vskRisksVariantList[$risk]['rus'];
            }
        }
    }

    public static function getAdditionalConditionUID($alphaAdditionalCondition)
    {
        return self::$vskAdditionalConditions[$alphaAdditionalCondition] ?? null;
    }

}