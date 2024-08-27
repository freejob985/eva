<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/*
*
* ---------------how to use-----------------
* ------------------------------------------
* Developed by <sourav.diubd@gmail.com>
*
* $autoload['helper'] =  array('lang');

* display a language
* echo display('helloworld'); 

* display language list
* $lang = languageList(); 
* ------------------------------------------
*
*/


if (!function_exists('display')) {

    function display($text = null)
    {
        $ci =& get_instance();
        $ci->load->database();
        $userLang = $ci->input->cookie('Lng', true);
        $table  = 'language';
        $phrase = 'phrase';
        $setting_table = 'setting';
        $default_lang  = 'english';

        //set language  
        $data = $ci->db->get($setting_table)->row();
        if (!empty($data->language)) {
            if(!empty($userLang )){
                $language = $userLang ; 
            }else{
                $language = $data->language;
            }
             
        } else {
            $language = $default_lang; 
        } 
 
        if (!empty($text)) {

            if ($ci->db->table_exists($table)) { 

                if ($ci->db->field_exists($phrase, $table)) { 

                    if ($ci->db->field_exists($language, $table)) {

                        $row = $ci->db->select($language)
                              ->from($table)
                              ->where($phrase, $text)
                              ->get()
                              ->row(); 

                        if (!empty($row->$language)) {
                            return $row->$language;
                        } else {
                            return false;
                        }

                    } else {
                        return false;
                    }

                } else {
                    return false;
                }

            } else {
                return false;
            }            
        } else {
            return false;
        }  

    }
 
}




if (!function_exists('dd')) {
    function dd(...$vars)
    {
        // ألوان مختلفة ومتناغمة
        $colors = [
            '#ff9999', '#66b3ff', '#99ff99', '#ffcc99', '#c2c2f0',
            '#ffb3e6', '#c2f0c2', '#ffccff', '#ffb3b3', '#c2c2c2'
        ];
        $colorCount = count($colors);
        
        // الحصول على معلومات إضافية
        $backtrace = debug_backtrace();
        $debugInfo = [
            'line' => $backtrace[0]['line'],
            'file' => $backtrace[0]['file'],
            'function' => $backtrace[1]['function'] ?? 'N/A',
            'request' => $_REQUEST,
            'session' => $_SESSION ?? []
        ];

        // عرض المعلومات الافتراضية إذا لم يتم تمرير أي متغيرات
        if (empty($vars)) {
            $vars[] = [
                'file' => $debugInfo['file'],
                'line' => $debugInfo['line'],
                'function' => $debugInfo['function'],
                'request' => $debugInfo['request'],
                'session' => $debugInfo['session'],
            ];
        }

        echo '<div style="font-family: Arial, sans-serif; line-height: 1.5;">';
        
        foreach ($vars as $index => $var) {
            // حدد اللون بناءً على الفهرس
            $color = $colors[$index % $colorCount];
            
            echo '<div style="background-color: ' . $color . '; padding: 10px; border-radius: 5px; margin-bottom: 10px; color: #fff;">';
            
            // عنوان البلوك
            echo '<strong>Breakpoint (' . $debugInfo['file'] . ' on line ' . $debugInfo['line'] . ') ---> Function: ' . $debugInfo['function'] . '</strong><br>';
            echo '<strong>Request Data:</strong><br>';
            echo '<pre>' . json_encode($debugInfo['request'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
            echo '<strong>Session Data:</strong><br>';
            echo '<pre>' . json_encode($debugInfo['session'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
            
            // عرض المتغيرات
            echo '<strong>Variable ' . ($index + 1) . ':</strong><br>';
            if (is_array($var) || is_object($var)) {
                echo '<pre>' . json_encode($var, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
            } elseif (is_bool($var) || is_null($var)) {
                var_dump($var);
            } else {
                echo htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
            }
            
            echo '</div>';
        }
        
        echo '</div>';
        die(1);
    }
}






// $autoload['helper'] =  array('language_helper');

/*display a language*/
// echo display('helloworld'); 

/*display language list*/
// $lang = languageList(); 
