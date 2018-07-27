<?php

$url = SdkRestApi::getParam('url');

return file_get_contents($url);
