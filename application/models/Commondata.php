<?php

class Commondata extends CI_Model {

    protected $base_url = "/";

    public function __construct() {
        parent::__construct();
        
        $this->load->model('catalog');
        
    } // End constructor
    
    
    public function getAllHeaderDatas() {
    
        $result = array();
        
        $result['site_name'] = "Алмаз Строй";
        $result['site_slogan'] = "Строительство домов, бань, любые виды отделки";
        $result['site_contact_phones'] = "8-8342-30-01-50 &nbsp; &nbsp; &nbsp; &nbsp; 8-8342-30-01-86";
        $result['site_contact_address'] = "г. Саранск, ул. Лесная, 2Г";
        $result['site_base_url'] = $this->base_url;
        
        $result['top_menu'] = $this->_getTopMenuData();
        $result['footer_menu'] = $this->_getBottomMenuData();
        
        return $result;
    
    } // End function getAllHeaderDatas
    
    
    protected function _getTopMenuData() {
    
        $result = array();

        $result[] = array(
            'link' => $this->base_url,
            'title' => "Главная",
            'is_link' => true,
            'a_class' => "active"
        );        

        // Projects categories menu
        $projects_sub_menu = array();
        $projects_sub_menu[] = array(
            'link' => "/catalog/bestsellers/",
            'title' => "Популярные"
        );
        $projects_sub_menu[] = array(
            'link' => "#",
            'title' => "separator",
            'is_separator' => true
        );
        
        $filter = array( 'parent_id' => 0 );
        $ProjectCategories = $this->catalog->GetCategories($filter);
        foreach( $ProjectCategories as $item ) {
            $projects_sub_menu[] = array(
                'link' => "/catalog/categories/" . $item['id'] . "/",
                'title' => $item['name']
            );
        } // End foreach
        
        $result[] = array(
            'link' => "/catalog/",
            'title' => "Проекты",
            'is_link' => true,
            'sub_menu' => $projects_sub_menu
        );
        
        $result[] = array(
            'link' => "/examples/",
            'title' => "Наши работы",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "/additional/",
            'title' => "Дополнительные услуги",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "/actions/",
            'title' => "Акции",
            'is_link' => true
        );
        
        /*
        $result[] = array(
            'link' => "/info/",
            'title' => "Полезная информация",
            'is_link' => true
        );
        */
        $result[] = array(
            'link' => "/materials/",
            'title' => "Стройматериалы",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "/about/",
            'title' => "О компании",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "/contacts/",
            'title' => "Контакты",
            'is_link' => true
        );
        
        $result[] = array(
            'link' => "#",
            'title' => "8-8342-30-01-50 (30-01-86)",
            'is_link' => false,
            'li_class' => "menu-phone-point"
        );      
        
        $result[] = array(
            'link' => "#",
            'title' => "Отправить сообщение",
            'is_link' => true
        );
                
        return $result;
    
    } // End function _getTopMenuData
    
    
    protected function _getBottomMenuData() {
    
        $result = array();
        
        $result['catalog'] = array();
        $filter = array( 'parent_id' => 0 );
        $ProjectCategories = $this->catalog->GetCategories($filter);
        foreach( $ProjectCategories as $item ) {
            $result['catalog'][] = array(
                'link' => "/catalog/categories/" . $item['id'] . "/",
                'title' => $item['name']
            );
        } // End foreach 
        
        $result['catalog'][] = array(
            'link' => "/catalog/bestsellers/",
            'title' => "ПОПУЛЯРНЫЕ ПРОЕКТЫ"
        );       
        $result['catalog'][] = array(
            'link' => "/examples/",
            'title' => "НАШИ РАБОТЫ"
        );

        $result['pages'] = array();               
        $result['pages'][] = array(
            'link' => "/actions/",
            'title' => "Акции"
        );
        $result['pages'][] = array(
            'link' => "/additional/",
            'title' => "Дополнительные услуги"
        );
        $result['pages'][] = array(
            'link' => "/info/",
            'title' => "Полезная информация"
        );       
        $result['pages'][] = array(
            'link' => "/materials/",
            'title' => "Стройматериалы"
        );
        
        $result['contacts'] = array();
        $result['contacts']['phones'] = "8-8342-30-01-50, 8-8342-30-01-86";
        $result['contacts']['address'] = "г. Саранск, ул. Лесная, 2Г";        
        $result['contacts']['email'] = "скоро...";        
        $result['contacts']['scheme'] = array(
            'link' => "/scheme/",
            'title' => "схема проезда"
        );      
                
        $result['info'] = "© Алмаз Строй, 2016. 
        Строительство домов, бань, любые виды отделки. 
        Все материалы данного сайта являются объектами авторского права (в том числе дизайн). Запрещается копирование, распространение (в том числе путем копирования на другие сайты и ресурсы в Интернете) или любое иное использование информации и объектов без предварительного согласия правообладателя. Cайт не является публичной офертой.";
                                
        return $result;
    
    } // End function _getBottomMenuData
    
       
    public function getAdminLeftMenu($activeMenuPoint) {
    
        $result = array();
        
        $menu_block = array();
        $menu_block[] = array(
            'link' => "/admin/index/",
            'title' => "Главная"
        );    
        $result[] = $menu_block;
        
        $menu_block = array();
        $menu_block[] = array(
            'link' => "/admin/catalog_cat_list/",
            'title' => "Категории каталога"
        );   
        $result[] = $menu_block;          
        
        $menu_block = array();
        $menu_block[] = array(
            'link' => "/admin/catalog_list/",
            'title' => "Проекты"
        );   
        $result[] = $menu_block;    
        
        $menu_block = array();
        $menu_block[] = array(
            'link' => "/admin/examples_list/",
            'title' => "Примеры работ"
        );   
        $result[] = $menu_block;   
        
        foreach( $result as $block_id => $block ) {
            foreach( $block as $item_id => $item ) {
                if( $item['link'] == $activeMenuPoint ) {
                    $result[$block_id][$item_id]['active'] = true;
                } // End if                
            } // End foreach
        } // End foreach
                
        return $result;
    
    } // End function getAdminLeftMenu    
       
    public function getContentPage($ID) {
    
        $result = array();
        $pages = array();
        
        $pages[1] = array(
            'name' => "Полезная информация для покупателей",
            'content' => "
<h2>Оплата</h2>
<p>
Звоните нам и мы расскажем о возможных вариантах оплаты, а также сможем подсказать по стоимости дополнительных работ и материалов:
<ul>
<li>Фундамент;</li>
<li>Доставка;</li>
<li>Весь материал для сборки дома;</li>
<li>Работы по установке и сборке дома;</li>
<li>Окна, двери, кровля, материал для внутренней отделки;</li>
<li>Все остальные работы (устройство инженерных систем, дополнительное утепление, пристройка террас и веранд и т.д.);</li>
<li>Внутренняя отделка;</li>
<li>Почти полный спектр стройматериалов.</li>
</ul>
</p>
	
<h2>Доставка и сборка дома</h2>
<p>Подробности можно узнать по телефону 8-8342-30-01-50 или 8-8342-30-01-86</p>


<h2>Кредитование</h2>
<p>Компания «Алмаз Строй» сотрудничает с рядом проверенных и надежных банков. Более подробно Вы сможете узнать по телефону 8-8342-30-01-50 или 8-8342-30-01-86, а также у нас в офисе - г. Саранск, ул. Лесная, 2Г</p>

<h2>Работа строительной бригады</h2>
<p>Все наши специалисты имеют многолетний опыт в строительстве, сборке и установке домов, а также в отделочных и инженерных работах любой сложности. Также мы сможем подсказать по поводу подбора и приобретения всех необходимых материалов.</p>
<p>В большинстве случаев мы также можем помочь с подведением коммуникаций к дому.</p>
<p>Срок строительства (установки, сборки) для каждого проекта обсуждается отдельно.
В случае удаленного расположения объекта рабочие могут проживать на участке заказчика, который должен разместить их в пригодное для жизни помещение. Если такой возможности нет, то рабочие привезут с собой бытовку.</p>
<p>Клиент не оплачивает проживание бригады!</p>
<p>Дата начала работ обязательно обговаривается заранее.</p>
<p>Рабочий день строителей может быть ненормированным из-за погодных условий, но, как показывает практика, наши рабочие укладываются в обозначенный срок строительства.</p>

<h2>Клиентская служба</h2>
<p>Все возникающие вопросы на любом этапе работы Вы можете задать, обратившись по телефону 8-8342-30-01-50 или 8-8342-30-01-86</p>

<h2>Гарантия качества</h2>
<p>На всех этапах строительства дома заказчик имеет право осуществлять соответствующий контроль. После окончания строительства клиент осматривает готовое строение и подписывает акт приемки.</p>
<p>Предоставляемая гарантия зависит от типа работ и выбранного заказчиком материала.</p>            
            
            <a href=\"" . base_url() . "\">На главную</a>
            "
        );
        

        $pages[2] = array(
            'name' => "Дополнительные услуги",
            'content' => "
Помимо основного направления деятельности - строительства домов, бань и прочих объектов мы также можем предложить такие услуги как:

<ul><li>Достройка и реконструкция;</li>
<li>Проектирование, прокладка и запуск инженерных систем (в том числе отопление, водоснабжение, канализация);</li>
<li>Разработка индивидуальных проектов;</li>
<li>Благоустройство территории;</li>
<li>Пристройки террас и веранд;</li>
<li>Строительство ограждений;</li>
<li>Внешняя отделка;</li>
<li>Внутренняя отделка;</li>
<li>Фундамент;</li>
<li>Кровельные работы;</li>
<li>В ряде случаев - подвод коммуникаций;</li></ul>           
            
            <a href=\"" . base_url() . "\">На главную</a>
            "
        );
        
        $pages[3] = array(
            'name' => "Стройматериалы",
            'content' => "
Также мы занимаемся продажей стройматериалов.<br>
Подробности можно узнать по телефону 8-8342-30-01-50 или 8-8342-30-01-86        
            
            <a href=\"" . base_url() . "\">На главную</a>
            "
        );
        
        $pages[4] = array(
            'name' => "О компании",
            'content' => "
<p>«Алмаз Строй» - молодая успешно развивающаяся компания, образованная в 2016 году.<br><br>
Мы молоды, однако в нашем штате есть все специалисты, необходимые для проведения полного комплекса работ по строительству, устройству коммуникаций, отделке и многим другим сопутствующим видам работ. Все специалисты имеют достаточную квалификацию и все необходимые допуски, а опыт наших сотрудников позволяет нам говорить о высоком качестве и надежности проводимых работ. В этом Вы можете убедиться, перейдя в раздел \"Наши работы\".</p>

<p><strong>Наш адрес:</strong> г. Саранск, ул. Лесная, 2Г<br>
<strong>Телефоны:</strong> 8-8342-30-01-50 или 8-8342-30-01-86</p>

<p><strong>Наши реквизиты:</strong>
</p>
           
            <a href=\"" . base_url() . "\">На главную</a>
            "
        );
        
        $pages[5] = array(
            'name' => "Контакты",
            'content' => "
<p><strong>Наш адрес:</strong> г. Саранск, ул. Лесная, 2Г<br>
<strong>Телефоны:</strong> 8-8342-30-01-50 или 8-8342-30-01-86</p>
           <p>
           <strong>На карте:</strong>
           <script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=2FotHxuu2F5mwUgolU14uGiijfX5ZxkS&amp;width=840&amp;height=400&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true\"></script>
           </p>
            <a href=\"" . base_url() . "\">На главную</a>
            "
        );
        
        if( isset( $pages[$ID] ) ) {
            $result = $pages[$ID];
        } // End if
                
        return $result;
    
    } // End function getContentPage

} // End Commondata

?>