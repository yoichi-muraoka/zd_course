<?php
$constIni = parse_ini_file("const.ini");
const CONTEXT_ROOT = "zd_course";

define("DB_NAME", $constIni["DB_NAME"]);
define("DB_USER", $constIni["DB_USER"]);
define("DB_PASS", $constIni["DB_PASS"]);

const COURSE_NAME = "Java Course";
define("COURSE_START", $constIni["COURSE_START"]);
define("COURSE_END", $constIni["COURSE_END"]);

const COURSE_GOOGLE_DRIVE_URL = "https://drive.google.com/drive/folders/1I9xO83n8nIkgC9GMES-W5MquIGrq8SbH?usp=sharing";
const COURSE_TEMP_CODE_URL = "https://docs.google.com/document/d/1NFrgI1rK84LJErNhqHh5k7itEWz9RKGHRSR08P_DYxc/edit?usp=sharing";
const COURSE_ASYNC_FOLDER_URL = "";