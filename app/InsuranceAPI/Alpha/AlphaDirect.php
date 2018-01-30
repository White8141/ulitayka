<?php
namespace App\InsuranceAPI\Alpha;

/**
 * Содержит массив со странами и их id для альфастраха
 */
class AlphaDirect
{
    private static $alphaCountriesList = [
        'CARIBBEAN' => 'a756ab44-c053-457f-9096-32fa20dfbedb',
        'SCHENGEN' => 'caf93035-7ece-43f7-928d-a1e8d186fb48',
        'ABKHAZIA' => 'cd75aa28-5eea-41c3-9aaf-e631224caf6c',
        'AUSTRALIA' => 'bc43228f-8fa3-440a-afef-15b9e57e215c',
        'AUSTRIA' => 'a4584f16-54c2-475f-869c-55afc5d15e10',
        'AZERBAIJAN' => '8878a6d2-5832-48cf-81fd-31de9369378d',
        'ALBANIA' => '13babf7e-5be0-4832-9163-a18ddc70b334',
        'ALGERIA' => '1ebae08d-7e24-4a98-af8b-caa4b7c8b699',
        'ANGOLA' => 'e8474e8a-7f48-41fd-9f2a-086f2ff65952',
        'ANDORRA' => '30f51b18-cb5f-493c-995e-56166ecde198',
        'ANTIGUA' => '5da1b906-5711-433c-bf9b-b5560593883d',
        'ARGENTINA' => 'f8e42f4a-ecd5-4b00-86ec-0f71d53b50d4',
        'ARMENIA' => '90474e75-e73f-4565-ab29-48d9c1fcd91f',
        'AFGANISTAN' => '017bb780-2325-47b2-9cdf-518512b39247',
        'BAHAMAS' => '20e65e66-a2ad-41f5-9103-303c131659f3',
        'BANGLADESH' => '7e1051e5-b447-42d9-87b0-e88d8c33708c',
        'BARBADOS' => '366b5385-7139-442f-be0d-c180c2646f76',
        'BAHRAIN' => 'b1beac74-4aeb-455d-8ba5-d26a8d4e145c',
        'BELIZE' => 'd5a2f948-6167-46f2-8d8b-84cf9f9fbd7b',
        'BELORUSSIA' => 'b4cfb38e-3983-46fe-95ad-f47cfa3b6622',
        'BELGIUM' => '0496f0ee-f81e-4edc-98b3-d31151e2e844',
        'BENIN' => '6a4dc278-b7e2-45a4-bda6-d6f771191a52',
        'BERMUDAS' => '077c9e9f-cf76-4499-bbe4-12977c42b14c',
        'BULGARIA' => '0cfbec4c-e767-4647-8d28-961cb6a14705',
        'BOLIVIA' => '40253d48-9920-478c-bd4a-2f2198f67c7c',
        'BOSNIA' => '56c5eb56-550b-4fd0-8f75-19c98301bb12',
        'BOTSVANA' => '1b48dea7-161b-4c49-a0ad-fe32458f3339',
        'BRAZIL' => 'b5b1a038-af78-4cfd-8979-0d35d5c7615b',
        'BRUNEI' => 'c6c6463e-de84-4c0f-9daa-14c7cee86f32',
        'BURUNDI' => '686639c3-93e0-4c3e-9c0e-d582c02814ce',
        'BHUTAN' => '23d78a42-cf09-41f6-9f2a-9956dce02dc0',
        'VATICAN' => '4c72009b-9d72-4bd7-8ef3-03c849bcd22d',
        'BRITAIN' => '7ba0c7b1-3cc3-401e-95de-f66eb7beec52',
        'HUNGARY' => '87c55dc3-7aac-47d9-8abb-fbb87e79bde6',
        'VENEZUELA' => 'f706bf02-1c2f-4509-ab9a-ac9f5c4b2e50',
        'VIETNAM' => '7903a425-d292-413f-aebc-013fbbd275cd',
        'HAITI' => '1c79878e-78e3-4c99-8258-b13068523cbd',
        'GABON' => '71898a2b-10d3-4c37-8b1a-e26b17595f80',
        'GYANA' => '4e78ae6b-864a-440b-b995-f85a90782f06',
        'GANA' => '04a54610-b448-4306-8196-0af7822a2361',
        'GUADELOUPE' => '411d95dc-b685-4006-a527-bb830796f841',
        'GUATEMALA' => '1822d0a4-e659-408e-9bde-81f710920d6f',
        'GUIANA' => '95ad6d16-d073-42c1-81fd-52879e8a25fb',
        'GERMANY' => '719744e2-6163-4f37-a705-db1931830558',
        'GIBRALTAR' => '9fc4f073-a83f-400e-aaf8-68768db6c5de',
        'HONDURAS' => '88d73ed6-ccd5-4027-a9e1-95dc8c4ddadb',
        'GRENADA' => '66c5eb4e-7cfd-4f33-9fa7-aa5e76b17ad9',
        'GREENLAND' => 'fe1b039f-2d43-4bf3-9fa3-be7b73c75acc',
        'GREECE' => '041e5775-a77f-4fc7-ba55-ee15035fbf87',
        'GEORGIA' => 'e16aa5d5-7e8e-4c20-8cfc-b75670fd6be0',
        'GUAM' => 'f84bcf4c-51d4-4485-93bd-879b01f89511',
        'DENMARK' => 'c28d553d-7341-4ee1-83f7-f171a9e5a4b2',
        'DOMINICA' => 'f50dac82-8953-4f5d-a3eb-c5dfd15917e5',
        'DOMINICAN' => 'a3875eb8-a3ca-4ef3-a8f6-c25cdab6ec43',
        'EGYPT' => 'd4af6190-fc85-4adc-87d1-cdae56de8f9a',
        'ZAMBIA' => '43166b7e-ffff-430c-b9a6-ceb30dbac472',
        'ZIMBABWE' => '7abbd115-541c-4d69-984e-a6b10fafbfe1',
        'ISRAEL' => '8dacae81-2229-4ae1-a82a-c680ab216b41',
        'INDIA' => 'f4e33816-36bf-470b-9872-d23c1b98bd27',
        'INDONESIA' => 'aac6b1e1-42cd-4109-98dd-6aa2ac48a7da',
        'JORDAN' => '62bf5102-002d-4811-a031-47264f690dc4',
        'IRAQ' => '547929b2-8745-4370-8556-54d974e1daf0',
        'IRAN' => '69bb99e1-3948-4c3a-88a4-f0851f499a36',
        'IRELAND' => '82a64f74-4d10-4042-acf3-3ca298f7cba8',
        'ICELAND' => '9cc6e95a-f88c-44e1-b082-dc6decfd7923',
        'SPAIN' => '56c88167-b93e-42fb-aaee-694fe130d02f',
        'ITALY' => '0e7d2f08-56fa-4118-957f-71c80f9af7b1',
        'YEMEN' => '67be97ee-28f8-4038-8ac8-54ab09c4e196',
        'CABO VERDE' => '8a4f5b0c-70ff-4d63-bb32-a3a6afcd69a6',
        'KAZAKHSTAN' => 'a5997880-69e6-4dc0-9259-6213806de9d5',
        'CAYMAN' => '2fb4e78f-4113-4d22-892e-feeda4798342',
        'CAMBODIA' => '9c6bfefc-86d9-4371-9c6c-8348368af53e',
        'CAMEROON' => 'ca8cc94e-db72-4c33-8889-f0fc7ac9e6b8',
        'CANADA' => 'e941223a-08ab-403e-b2af-ce29e925b6c7',
        'QATAR' => '2427b8ce-abd4-418a-a59b-d030c0f0e605',
        'KENYA' => '0280b4f1-bd6b-42be-965e-cb99937bd215',
        'CYPRUS' => 'abca1e52-a01c-4918-b882-4a3f49867150',
        'KYRGYZSTAN' => 'b3102ccf-ce17-4406-a4c0-14a11c3639a6',
        'CHINA' => '5e8782ed-0101-4cf7-9935-7bea291221f7',
        'COCOS' => 'f53658f3-98d0-4c25-8c66-c7ddee5064a6',
        'COLOMBIA' => '596f1ba5-91ac-4cfa-8a1c-7b0ee5c2c6c0',
        'COMORO' => '77d27328-f017-43ee-8085-337711c9c80a',
        'CONGO' => '0679d86b-0aba-49ca-bb0f-7b42359c8a04',
        'COSTA' => 'b1083901-fc68-4083-8b9e-db914fd1daf8',
        'CUBA' => 'a7aab24a-c31e-4050-92de-343f82b574bb',
        'KUWAIT' => '7c51b888-0abf-4aa3-a771-c34672eaa92e',
        'LAO' => '8eb102ab-c03f-426f-b442-f1a77a193982',
        'LATVIA' => 'd7950eb6-2e06-4360-9b5d-6be6f80b7248',
        'LIBERIA' => 'ec3483ea-64c7-4b8d-a894-e42b403bb0df',
        'LEBANON' => 'ed6f1f9c-2864-4a27-a6e8-a673f40aa453',
        'LIBYAN' => 'bcd5ee69-0c0c-4ede-ba5e-c7719990dfac',
        'LITHUANIA' => '9e6a58b7-efb6-4e00-aa84-3e820582158a',
        'LIECHTENSTEIN' => 'ea25191f-b156-4f27-be4c-3d855dbb7910',
        'LUXEMBOURG' => 'af5053c5-5880-4f7f-9006-9540589c9c17',
        'MAURITIUS' => '0b3479e1-afe1-4c97-a3bf-5713a7d6bd46',
        'MAURITANIA' => '25c5b38b-4ea7-4291-a822-c25eb04bb3da',
        'MADAGASCAR' => '3d305431-75bf-4384-9533-d9279a47c9a6',
        'MACEDONIA' => '8080cc17-521f-4722-8c42-a75dc3897fc5',
        'MALAYSIA' => 'd420b1a7-f29c-4189-9eac-5c103fc4ae23',
        'MALI' => '52562ce0-b89d-4447-aee1-cba0d89db150',
        'MALDIVES' => 'a023115d-b43e-4ff6-bc66-9e28e3114ea5',
        'MALTA' => '6cdf09f2-bb22-41b2-a567-be47dfaaf1f6',
        'MOROCCO' => '7283d61d-684a-4289-bc98-2f56f753c442',
        'MEXICO' => '6cd125f2-9798-466a-b2dd-2ce13a5d410e',
        'MOZAMBIQUE' => 'e1a3f98c-00ad-48e6-b8a6-1e889b8fcfc7',
        'MOLDOVA' => '9c6b9308-72a1-4f26-b13b-abab0b250c82',
        'MONACO' => 'a8be18f1-bd9a-493f-94e9-90ea241254f5',
        'MONGOLIA' => 'f39aa2b8-a992-4aa1-92c6-66386cb7d5f8',
        'MONTENEGRO' => 'e709ee95-21f6-442e-801c-f5d31eafedad',
        'MYANMAR' => '46af1fa6-fd3d-4be9-93f3-fdfa829bcc3e',
        'NAMIBIA' => '747677e4-4d99-4485-b21b-d4b905f99ffd',
        'NAURU' => '89b5d7e9-217e-4474-b639-71e40773c897',
        'NEPAL' => '1b21dddf-b569-400e-b6b4-3bfb07bdc75f',
        'NIGER' => 'ced162df-32db-4d67-a6cd-42e18228ba57',
        'NIGERIA' => '4549e731-3747-40a9-9a5f-49d8cb64931a',
        'NETHERLAND' => 'd60db398-8a8b-43d4-a1e0-f6889074d68e',
        'NICARAGUA' => 'f6b22a98-a22b-435f-9a4f-069cb885d470',
        'ZEALAND' => '29bf311b-f6a6-4436-bce6-9df1eda6e9b0',
        'NORWAY' => '61efe5f2-08b6-4443-8748-8757a2a4502c',
        'UAE' => 'f10b5e59-dbe3-4f26-b5c6-df062491870a',
        'OMAN' => '4c3de1ee-9cf4-49eb-a27a-964c6aa282ee',
        'COOK' => '5ca0c578-01fc-418d-a60a-0eb885175d2a',
        'PAKISTAN' => '4b586e28-2908-4547-a621-42c8cb770811',
        'PANAMA' => 'c340d379-54cd-4a5f-9521-4306c5b27829',
        'PAPUA' => '3931a2b4-3170-4373-9427-54e38ab868a9',
        'PARAGUAY' => '8669c7af-7742-455d-81b1-d5ac15ec6738',
        'PERU' => 'ec84b79e-decc-4c85-90b2-14fff887520a',
        'POLAND' => '1c4ce256-eda4-4f0e-8a73-beaeefb30904',
        'PORTUGAL' => 'eb3511d6-b241-43ae-8e3b-76097eb87202',
        'PUERTO' => 'a78e40e3-561e-47c9-a009-44dfdb288e27',
        'RUSSIA' => '4acdbb5e-cb44-44c9-88e1-dcc57b8279c8',
        'RUANDA' => '8d0bd507-f231-408b-8a99-365344dcf243',
        'ROMANIA' => '74629ea6-6f70-4843-8625-401d4978b44d',
        'USA' => '49d6f927-a940-4ac2-9234-3aeef4c6662b',
        'SALVADOR' => '78b77f30-ba6c-4292-baa9-4d6e74490843',
        'SANMARINO' => '2ec8b021-7775-4e49-bf1b-88292292e63e',
        'ARABIA' => 'a25c780d-f581-4610-bfe4-5bd48b0e711f',
        'NCOREA' => '192f8d98-c21e-46b8-b669-3045abbbe6f5',
        'SEYCHELLES' => '9bdd3837-5db5-4cfe-a543-99115706dc6a',
        'SENEGAL' => '9d52d874-ab5a-415c-98ca-9217ea3bbd42',
        'SERBIA' => 'abaf809c-75ab-4009-9d1f-09430f66b38a',
        'SINGAPORE' => 'a918dc49-9137-4085-82e4-2dde8a416b30',
        'SYRIA' => 'f7a526cd-3755-4ff9-826c-75ec50cf4a51',
        'SLOVAKIA' => 'd5454ac6-d1b9-4813-92df-34ce9ef9bf1c',
        'SLOVENIA' => '8b5137b4-581a-4550-b1cc-227ad0e3d5ca',
        'SOLOMON' => '8be5f403-7f8f-437f-918d-1d2299fa6de7',
        'SOMALIA' => '285f33de-30ab-42dc-bbea-e64c7f915ba7',
        'SUDAN' => 'a13ec8ea-f307-4554-8db4-223e750927be',
        'TADJIKISTAN' => '3b7e7f77-6ae9-4db9-b43c-760d4790c595',
        'THAILAND' => '7bcae789-2afa-4d15-8767-9d2f992f1255',
        'TAIWAN' => 'bb87734d-d0f0-4240-9257-9e17b61dd57a',
        'TANSANIA' => 'bdc5dd8a-6549-4abb-8d24-ce189dedcb9e',
        'TOGO' => '070fa2ad-f424-46b0-bdd6-07ec4a145d40',
        'TRINIDAD' => 'Тринидад и Тобаго',
        'TUNISIA' => '9c8d16ed-c84b-4537-9a3c-3695a34e1ecf',
        'TURKMENISTAN' => '7045486f-2651-4955-88bc-19b51e84de64',
        'TURKEY' => '9daaf7cf-748d-4991-bd9b-401dd6c860a4',
        'UGANDA' => '35da26eb-966b-4910-91eb-476166064725',
        'UZBEKISTAN' => 'd4fda620-27b8-4334-a98a-7ee94a6879e5',
        'UKRAINE' => 'fdb07bae-4037-4166-954a-daa9c096f37a',
        'URUGUAY' => '3f6d70ee-a7a6-4851-8d0d-13eb9ad3c0df',
        'FAEROES' => 'e17493d8-b64d-4dd8-a61e-87ab593a8663',
        'FIJI' => '56184240-9088-4e24-b2e6-ac3006f093b3',
        'PHILIPPINES' => '1479dd15-8f97-48f4-921d-a1a3db0766eb',
        'FRANCE' => '11792384-c1dc-4867-b520-cb223ce11611',
        'HEARD' => '09817d07-fc89-48ce-90d8-a3b7f95ef9b8',
        'CROATIA' => '3dcf5602-a51e-4896-86b8-0a0af26937d1',
        'CAR' => '23dbb4d6-b778-48bb-8aed-c0fd545c0f00',
        'CHAD' => '4978fa8c-7f08-4edb-944b-7e640932e837',
        'CZECH' => '70dc4a9e-8e0d-41f5-ae5e-167695c7c443',
        'SWITZERLAND' => 'd7e3123a-db4b-4266-94c3-e8a78b76cdd9',
        'SWEDEN' => '032d2334-b371-4379-8994-78b76a05027f',
        'SRILANKA' => '70f03d17-9edf-4985-a279-5d1ac93a815b',
        'ECUADOR' => '136d9a68-9924-4899-bd49-3094b55f504b',
        'GUINEA' => 'ea2d6810-3ca7-4386-9656-d0f751c0c06a',
        'ESTONIA' => '67b6c2b6-4a63-47ca-8894-a90a12b4bcfd',
        'ETHIOPIA' => 'e2d52601-6e57-4b07-836c-8603f260eb6a',
        'SAFRICA' => '86dcda66-ccdd-414a-b646-f8462fad2675',
        'KOREA' => '101b9275-8bbb-4467-80ab-0eec421ba93d',
        'JAMAICA' => '8ccbaa57-f4b5-465d-9fb3-799c6e1c3b85',
        'JAPAN' => '3cb2d2df-08b4-4b01-8467-b272262088e9',
        'SAMOA' => '89a760b2-6dca-4159-9c14-cbb80698fe63'
    ];

    private static $alphaRisksList = [
        'medical' => '4315533d-e4b2-4609-b4e4-df598cdd9705',
        'public' => '22e49815-4f76-4b84-a655-a9c19424c4b7',
        'cancel' => 'e041e5b7-6567-4210-8702-6a29e3fef229',
        'accident' => '1d71999c-be21-4bc9-a55d-d6af8129c3bf',
        'property' => '6c37f82b-82a0-4ceb-8af6-d7f3e8c752f3',
        'laggage' => '9f1bbb12-e28d-4f36-92ba-ecf225af967e',
    ];

    private static $alphaAdditionalConditions = [
        'leisure' => '06cae2f2-49cf-4045-85a6-abe95ef650e1',
        'competition' => '1c3021d0-305b-4233-91e2-92c1f695e51a',
        'extreme' => 'bbea6fd7-020e-44de-97ff-64f8804afaaa'
    ];

    public static function getCountryUID($country)
    {
        return self::$alphaCountriesList[$country] ?? null;
    }

    public static function getRiskUID($risk)
    {
        return self::$alphaRisksList[$risk] ?? null;
    }

    public static function getAdditionalConditionUID($alphaAdditionalCondition)
    {
        return self::$alphaRisksList[$alphaAdditionalCondition] ?? null;
    }

}