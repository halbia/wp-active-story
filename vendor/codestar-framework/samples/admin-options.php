<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = '_prefix_my_options';

//
// Create options
//
CSF::createOptions( $prefix, array(
  'menu_title' => 'تنظیمات دمو',
  'menu_slug'  => 'demo-options',
) );

//
// Create a section
//
CSF::createSection( $prefix, array(
  'title'  => 'بررسی اجمالی',
  'icon'   => 'fas fa-rocket',
  'fields' => array(

    //
    // A text field
    //
    array(
      'id'    => 'opt-text',
      'type'  => 'text',
      'title' => 'متن',
    ),

    array(
      'id'    => 'opt-textarea',
      'type'  => 'textarea',
      'title' => 'متن چندخطی',
      'help'  => 'متن توضیح کوتاه',
    ),

    array(
      'id'    => 'opt-upload',
      'type'  => 'upload',
      'title' => 'آپلود',
    ),

    array(
      'id'    => 'opt-switcher',
      'type'  => 'switcher',
      'title' => 'دکمه سوئیچ',
      'label' => 'متن توضیح کوتاه .',
    ),

    array(
      'id'      => 'opt-color',
      'type'    => 'color',
      'title'   => 'رنگ',
      'default' => '#3498db',
    ),

    array(
      'id'    => 'opt-checkbox',
      'type'  => 'checkbox',
      'title' => 'چک باکس',
      'label' => 'متن توضیح کوتاه .',
    ),

    array(
      'id'      => 'opt-radio',
      'type'    => 'radio',
      'title'   => 'رادیو باتن',
      'options' => array(
        'yes'   => 'بله لطفا',
        'no'    => 'خیر ممنون',
      ),
      'default' => 'yes',
    ),

    array(
      'id'          => 'opt-select',
      'type'        => 'select',
      'title'       => 'انتخاب',
      'placeholder' => 'یک گزینه انتخاب کنید',
      'options'     => array(
        'opt-1'     => 'گزینه 1',
        'opt-2'     => 'گزینه 2',
        'opt-3'     => 'گزینه 3',
      ),
    ),

    array(
      'id'      => 'opt-image-select',
      'type'    => 'image_select',
      'title'   => 'انتخاب گر عکس',
      'options' => array(
        'opt-1' => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
        'opt-2' => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
        'opt-3' => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
        'opt-4' => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
        'opt-5' => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
      ),
      'default' => 'opt-1',
    ),

    array(
      'id'    => 'opt-background',
      'type'  => 'background',
      'title' => 'پس زمینه',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'success',
      'content' => 'یک <strong>پیغام</strong> با استایل <strong>موفقیت</strong>',
    ),

    array(
      'id'    => 'opt-icon',
      'type'  => 'icon',
      'title' => 'انتخاب گر آیکن',
    ),

    array(
      'id'    => 'opt-alt-text',
      'type'  => 'text',
      'title' => 'متن',
    ),

    array(
      'id'         => 'opt-alt-textarea',
      'type'       => 'textarea',
      'title'      => 'متن چندخطی',
      'subtitle'   => 'توضیح متن چندخطی',
      'shortcoder' => 'csf_demo_shortcodes',
    ),

  )
) );

//
// Basic Fields
//
CSF::createSection( $prefix, array(
  'id'    => 'basic_fields',
  'title' => 'فیلد های ابتدایی',
  'icon'  => 'fas fa-plus-circle',
) );

//
// Field: text
//
CSF::createSection( $prefix, array(
  'parent'      => 'basic_fields',
  'title'       => 'متن',
  'icon'        => 'far fa-square',
  'description' => 'برای اطلاعات بیشتر در مورد فیلد های متنی سایت مقابل را بررسی بفرمائید : <a href="http://codestarframework.com/documentation/#/fields?id=text" target="_blank">Field: text</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-text-1',
      'type'  => 'text',
      'title' => 'متن',
    ),

    array(
      'id'      => 'opt-text-2',
      'type'    => 'text',
      'title'   => 'متن',
      'default' => 'متن با مقدار پیشفرض',
    ),

    array(
      'id'       => 'opt-text-3',
      'type'     => 'text',
      'title'    => 'متن با توضیح اضافی',
      'subtitle' => 'متن توضیح اول',
      'help'     => 'متن توضیج دوم',
      'before'   => '<p>متن اول بالای فیلد</p>',
      'after'    => '<p>متن دوم پائین فیلد</p>',
    ),

    array(
      'id'          => 'opt-text-4',
      'type'        => 'text',
      'title'       => 'متن با placeholder',
      'placeholder' => 'چیزی بنویسید...'
    ),

    array(
      'id'         => 'opt-text-5',
      'type'       => 'text',
      'title'      => 'متن غیرفعال',
      'attributes' => array(
        'readonly' => 'readonly'
      ),
      'default'    => 'این فیلد فقط برای نمایش است و امکان تغییر را ندارد'
    ),

    array(
      'id'          => 'opt-text-6',
      'type'        => 'text',
      'title'       => 'متن با امکان ورود حداکثر 5 کاراکتر',
      'attributes'  => array(
        'maxlength' => '5'
      ),
      'default'     => 'تست',
    ),

    array(
      'id'         => 'opt-text-7',
      'type'       => 'text',
      'title'      => 'متن با استایل اختصاصی',
      'attributes' => array(
        'style'    => 'width: 100%; height: 40px; border-color: #93C054;'
      ),
    ),

    array(
      'id'    => 'opt-text-8',
      'type'  => 'text',
      'after' => '<p>این فیلد در صورت وارد نکردن عنوان با عرض کامل نمایش داده می شود</p>',
    ),

  )
) );

//
// Field: textarea
//
CSF::createSection( $prefix, array(
  'parent'      => 'basic_fields',
  'title'       => 'متن چندخطی',
  'icon'        => 'far fa-square',
  'description' => 'اطلاعات بیشتر در مورد متن های چندخطی: <a href="http://codestarframework.com/documentation/#/fields?id=textarea" target="_blank">متن های چندخطی</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-textarea-1',
      'type'  => 'textarea',
      'title' => 'متن چندخطی',
    ),

    array(
      'id'      => 'opt-textarea-2',
      'type'    => 'textarea',
      'title'   => 'متن چندخطی با مقدار پیشفرض',
      'default' => 'متن پیشفرض',
    ),

    array(
      'id'          => 'opt-textarea-3',
      'type'        => 'textarea',
      'title'       => 'متن چندخطی با placeholder',
      'placeholder' => 'متنی بنویسید...'
    ),

    array(
      'id'         => 'opt-textarea-4',
      'type'       => 'textarea',
      'title'      => 'متن چندخطی با shortcoder',
      'shortcoder' => 'csf_demo_shortcodes',
    ),

    array(
      'id'       => 'opt-textarea-5',
      'type'     => 'textarea',
      'title'    => 'توضیح اول',
      'subtitle' => 'توضیح دوم',
      'help'     => 'توضیح سوم',
      'before'   => '<p>توضیح بالا</p>',
      'after'    => '<p>توضیح پائین</p>',
    ),

    array(
      'id'    => 'opt-textarea-6',
      'type'  => 'textarea',
        'after' => '<p>این فیلد در صورت وارد نکردن عنوان با عرض کامل نمایش داده می شود</p>',
    ),

  )
) );

//
// Field: select
//
CSF::createSection( $prefix, array(
  'parent'      => 'basic_fields',
  'title'       => 'انتخاب گر ها',
  'icon'        => 'fas fa-list',
  'description' => 'اطلاعات بیشتر در مورد انتخاب گر ها: <a href="http://codestarframework.com/documentation/#/fields?id=select" target="_blank">انتخاب گر ها </a>',
  'fields'      => array(

    array(
      'id'          => 'opt-select-1',
      'type'        => 'select',
      'title'       => 'انتخاب',
      'placeholder' => 'یک گزینه انتخاب کنید',
      'options'     => array(
        'opt-1'     => 'گزینه اول',
        'opt-2'     => 'گزینه دوم',
        'opt-3'     => 'گزینه سوم',
      ),
    ),

    array(
      'id'          => 'opt-select-2',
      'type'        => 'select',
      'title'       => 'انتخاب با مقدار پیشفرض',
      'placeholder' => 'یک گزینه انتخاب کنید',
      'options'     => array(
          'opt-1'     => 'گزینه اول',
          'opt-2'     => 'گزینه دوم',
          'opt-3'     => 'گزینه سوم',
      ),
        'opt-2'     => 'گزینه دوم',
    ),

    array(
      'id'          => 'opt-select-3',
      'type'        => 'select',
      'title'       => 'انتخاب با زیرمجموعه',
      'placeholder' => 'یک گزینه انتخاب کنید',
      'options'     => array(
        'گروه اول'   => array(
            'opt-1'     => 'گزینه اول',
            'opt-2'     => 'گزینه دوم',
            'opt-3'     => 'گزینه سوم',
        ),
        'گروه دوم'   => array(
            'opt-1'     => 'گزینه اول',
            'opt-2'     => 'گزینه دوم',
            'opt-3'     => 'گزینه سوم',
        ),
        'گروه سوم'   => array(
            'opt-1'     => 'گزینه اول',
            'opt-2'     => 'گزینه دوم',
            'opt-3'     => 'گزینه سوم',
        ),
      ),
    ),

    array(
      'id'         => 'opt-select-4',
      'type'       => 'select',
      'title'      => 'انتخاب چندتایی',
      'multiple'   => true,
      'attributes' => array(
        'style'    => 'min-width: 200px;'
      ),
      'options'    => array(
        'opt-1'     => 'گزینه اول',
        'opt-2'     => 'گزینه دوم',
        'opt-3'     => 'گزینه سوم',
        'opt-4'    => 'گزینه چهارم',
        'opt-5'    => 'گزینه پنجم',
        'opt-6'    => 'گزینه ششم',
      ),
      'default'    => array( 'opt-2', 'opt-3' ),
    ),

    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => 'انتخاب گر با <strong>استایل</strong> متفاوت',
    ),

    array(
      'id'          => 'opt-select-5',
      'type'        => 'select',
      'title'       => 'انتخاب',
      'chosen'      => true,
      'placeholder' => 'یک گزینه انتخاب کنید',
      'options'     => array(
          'opt-1'     => 'گزینه اول',
          'opt-2'     => 'گزینه دوم',
          'opt-3'     => 'گزینه سوم',
          'opt-4'    => 'گزینه چهارم',
          'opt-5'    => 'گزینه پنجم',
          'opt-6'    => 'گزینه ششم',
      ),
    ),

    array(
      'id'          => 'opt-select-6',
      'type'        => 'select',
      'title'       => 'انتخاب چندتایی',
      'chosen'      => true,
      'multiple'    => true,
      'placeholder' => 'یک گزینه انتخاب کنید',
      'options'     => array(
          'opt-1'     => 'گزینه اول',
          'opt-2'     => 'گزینه دوم',
          'opt-3'     => 'گزینه سوم',
          'opt-4'    => 'گزینه چهارم',
          'opt-5'    => 'گزینه پنجم',
          'opt-6'    => 'گزینه ششم',
      ),
    ),

    array(
      'id'          => 'opt-select-7',
      'type'        => 'select',
      'title'       => 'انتخاب با امکان جابجایی موارد انتخابی',
      'chosen'      => true,
      'multiple'    => true,
      'sortable'    => true,
      'placeholder' => 'یک گزینه انتخاب کنید',
      'options'     => array(
          'opt-1'     => 'گزینه اول',
          'opt-2'     => 'گزینه دوم',
          'opt-3'     => 'گزینه سوم',
          'opt-4'    => 'گزینه چهارم',
          'opt-5'    => 'گزینه پنجم',
          'opt-6'    => 'گزینه ششم',
      ),
      'default'     => array( 'opt-1', 'opt-2', 'opt-3' )
    ),

    array(
      'id'          => 'opt-select-8',
      'type'        => 'select',
      'title'       => 'انتخاب گر آژاکس برگه ها',
      'chosen'      => true,
      'multiple'    => true,
      'sortable'    => true,
      'ajax'        => true,
      'options'     => 'pages',
      'placeholder' => 'یک برگه انتخاب کنید',
    ),

    array(
      'id'          => 'opt-select-9',
      'type'        => 'select',
      'title'       => 'انتخاب گر آژاکس مطالب',
      'chosen'      => true,
      'multiple'    => true,
      'sortable'    => true,
      'ajax'        => true,
      'options'     => 'posts',
      'placeholder' => 'یک مطلب انتخاب کنید',
    ),

    array(
      'id'          => 'opt-select-10',
      'type'        => 'select',
      'title'       => 'انتخاب گر آژاکس دسته بندی ها',
      'chosen'      => true,
      'ajax'        => true,
      'options'     => 'category',
      'placeholder' => 'یک دسته بندی انتخاب کنید',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => 'انتخاب گر برای <strong>کوئری های وردپرس</strong> .',
    ),

    array(
      'id'          => 'opt-select-11',
      'type'        => 'select',
      'title'       => 'انتخاب گر برگه ها',
      'placeholder' => 'یک برگه انتخاب کنید',
      'options'     => 'pages',
    ),

    array(
      'id'          => 'opt-select-12',
      'type'        => 'select',
      'title'       => 'انتخاب گر نشوته ها',
      'placeholder' => 'یک نوشته انتخاب کنید',
      'options'     => 'posts',
    ),

    array(
      'id'          => 'opt-select-13',
      'type'        => 'select',
      'title'       => 'انتخاب گر دسته بندی ها',
      'placeholder' => 'یک دسته بندی انتخاب کنید',
      'options'     => 'categories',
    ),

    array(
      'id'          => 'opt-select-14',
      'type'        => 'select',
      'title'       => 'انتخاب گر منو',
      'placeholder' => 'یک منو انتخاب کنید',
      'options'     => 'menus',
    ),

    array(
      'id'          => 'opt-select-15',
      'type'        => 'select',
      'title'       => 'انتخاب گر مکان های منو ها',
      'placeholder' => 'یک مکان انتخاب کنید',
      'options'     => 'locations',
    ),

    array(
      'id'          => 'opt-select-16',
      'type'        => 'select',
      'title'       => 'انتخاب گر سایدبارها',
      'placeholder' => 'یک سایدبار انتخاب کنید',
      'options'     => 'sidebars',
    ),

    array(
      'id'          => 'opt-select-17',
      'type'        => 'select',
      'title'       => 'انتخاب گر نقش های کاربری',
      'placeholder' => 'یک نقش انتخاب کنید',
      'options'     => 'roles',
    ),

    array(
      'id'          => 'opt-select-18',
      'type'        => 'select',
      'title'       => 'انتخاب گر کاربران',
      'placeholder' => 'یک کاربر انتخاب کنید',
      'options'     => 'users',
    ),

    array(
      'id'          => 'opt-select-19',
      'type'        => 'select',
      'title'       => 'انتخاب گر پست تایپ ها',
      'placeholder' => 'یک پست تایپ انتخاب کنید',
      'options'     => 'post_types',
    ),

    array(
      'id'          => 'opt-select-20',
      'type'        => 'select',
      'title'       => 'انتخاب نوشته های پست تایپ ها',
      'placeholder' => 'یک نوشته انتخاب کنید',
      'options'     => 'posts',
      'query_args'  => array(
        'post_type' => 'your_post_type_name',
      ),
    ),

    array(
      'id'          => 'opt-select-21',
      'type'        => 'select',
      'title'       => 'انتخاب دسته بندی های یک پست تایپ',
      'placeholder' => 'یک پست تایپ انتخاب کنید',
      'options'     => 'categories',
      'query_args'  => array(
        'taxonomy'  => 'your_taxonomy_name',
      ),
    ),

  )
) );

//
// Field: checkbox
//
CSF::createSection( $prefix, array(
  'parent'      => 'basic_fields',
  'title'       => 'چکباکس ها',
  'icon'        => 'fas fa-check-square',
  'description' => 'اطلاعات بیشتر در مورد چکباکس ها: <a href="http://codestarframework.com/documentation/#/fields?id=checkbox" target="_blank">چکباکس ها</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-checkbox-1',
      'type'  => 'checkbox',
      'title' => 'چکباکس',
      'label' => 'توضیح مربوط به چکباکس',
    ),

    array(
      'id'      => 'opt-checkbox-2',
      'type'    => 'checkbox',
      'title'   => 'چکباکس با مقدار پیشفرض',
      'label' => 'توضیح مربوط به چکباکس',
      'default' => true,
    ),

    array(
      'id'      => 'opt-checkbox-3',
      'type'    => 'checkbox',
      'title'   => 'چکباکس انخاب چندتایی',
      'options' => array(
          'opt-1' => 'گزینه اول',
          'opt-2' => 'گزینه دوم',
          'opt-3' => 'گزینه سوم',
      ),
    ),

    array(
      'id'      => 'opt-checkbox-4',
      'type'    => 'checkbox',
      'title'   => 'چکباکس انتخاب چندتایی با استایل افقی',
      'inline'  => true,
      'options' => array(
          'opt-1' => 'گزینه اول',
          'opt-2' => 'گزینه دوم',
          'opt-3' => 'گزینه سوم',
      ),
    ),

    array(
      'id'      => 'opt-checkbox-5',
      'type'    => 'checkbox',
      'title'   => 'چکباکس با انتخاب پیشفرض',
      'options' => array(
          'opt-1' => 'گزینه اول',
          'opt-2' => 'گزینه دوم',
          'opt-3' => 'گزینه سوم',
      ),
      'default' => array( 'opt-1', 'opt-2' )
    ),

    array(
      'id'        => 'opt-checkbox-6',
      'type'      => 'checkbox',
      'title'     => 'چکباکس گروه بندی شده',
      'options'   => array(
        'گروه اول' => array(
            'opt-1' => 'گزینه اول',
            'opt-2' => 'گزینه دوم',
            'opt-3' => 'گزینه سوم',
        ),
        'گروه دوم' => array(
            'opt-1' => 'گزینه اول',
            'opt-2' => 'گزینه دوم',
            'opt-3' => 'گزینه سوم',
        ),
      ),
    ),

    array(
      'id'       => 'opt-checkbox-7',
      'type'     => 'checkbox',
      'title'    => 'چکباکس با انتخاب های زیاد',
      'options'  => array(
        'opt-1'  => 'گزینه اول',
        'opt-2'  => 'گزینه دوم',
        'opt-3'  => 'گزینه سوم',
        'opt-4'  => 'گزینه چهارم',
        'opt-5'  => 'گزینه پنجم',
        'opt-6'  => 'گزینه ششم',
        'opt-7'  => 'گزینه هفتم',
        'opt-8'  => 'گزینه هشتم',
        'opt-9'  => 'گزینه نهم',
        'opt-10' => 'گزینه دهم',
        'opt-11' => 'گزینه یازدهم',
        'opt-12' => 'گزینه دوازدهم',
        'opt-13' => 'گزینه سیزدهم',
        'opt-14' => 'گزینه چهاردهم',
        'opt-15' => 'گزینه پانزدهم',
      ),
      'desc'     => 'بعد از افزوده شدن گزینه های زیاد اسکرولر اضافه می شود',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => 'چکباکس برای کوئری های وردپرس',
    ),

    array(
      'id'      => 'opt-checkbox-8',
      'type'    => 'checkbox',
      'title'   => 'چکباکس دسته بندی وردپرس',
      'options' => 'categories',
    ),

  )
) );

//
// Field: radio
//
CSF::createSection( $prefix, array(
  'parent'      => 'basic_fields',
  'title'       => 'رادیو باتن ها',
  'icon'        => 'fas fa-dot-circle',
  'description' => 'اطلاعات بیشتر در مورد رادیو باتن ها : <a href="http://codestarframework.com/documentation/#/fields?id=radio" target="_blank">رادیو باتن ها </a>',
  'fields'      => array(

    array(
      'id'      => 'opt-radio-1',
      'type'    => 'radio',
      'title'   => 'رادیوباتن',
      'options' => array(
          'opt-1'  => 'گزینه اول',
          'opt-2'  => 'گزینه دوم',
          'opt-3'  => 'گزینه سوم',
      ),
    ),

    array(
      'id'      => 'opt-radio-2',
      'type'    => 'radio',
      'title'   => 'رادیو باتن با مقدار پیشفرض',
      'options' => array(
          'opt-1'  => 'گزینه اول',
          'opt-2'  => 'گزینه دوم',
          'opt-3'  => 'گزینه سوم',
      ),
      'default' => 'opt-2',
    ),

    array(
      'id'      => 'opt-radio-3',
      'type'    => 'radio',
      'title'   => 'رادیو باتن با استایل افقی',
      'inline'  => true,
      'options' => array(
          'opt-1'  => 'گزینه اول',
          'opt-2'  => 'گزینه دوم',
          'opt-3'  => 'گزینه سوم',
      ),
    ),

    array(
      'id'        => 'opt-radio-4',
      'type'      => 'radio',
      'title'     => 'رادیو باتن های گروهی ',
      'options'   => array(
        'گروه اول' => array(
            'opt-1'  => 'گزینه اول',
            'opt-2'  => 'گزینه دوم',
            'opt-3'  => 'گزینه سوم',
        ),
        'گروه دوم' => array(
          'opt-4' => 'گزینه چهارم',
          'opt-5' => 'گزینه پنجم',
          'opt-6' => 'گزینه ششم',
        ),
      ),
    ),

    array(
      'id'       => 'opt-radio-5',
      'type'     => 'radio',
      'title'    => 'رادیو باتن ',
      'options'  => array(
          'opt-1'  => 'گزینه اول',
          'opt-2'  => 'گزینه دوم',
          'opt-3'  => 'گزینه سوم',
          'opt-4'  => 'گزینه چهارم',
          'opt-5'  => 'گزینه پنجم',
          'opt-6'  => 'گزینه ششم',
          'opt-7'  => 'گزینه هفتم',
          'opt-8'  => 'گزینه هشتم',
          'opt-9'  => 'گزینه نهم',
          'opt-10' => 'گزینه دهم',
          'opt-11' => 'گزینه یازدهم',
          'opt-12' => 'گزینه دوازدهم',
          'opt-13' => 'گزینه سیزدهم',
          'opt-14' => 'گزینه چهاردهم',
          'opt-15' => 'گزینه پانزدهم',
      ),
        'desc'     => 'بعد از افزوده شدن گزینه های زیاد اسکرولر اضافه می شود',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'info',
      'content' => 'چکباکس برای کوئری های وردپرس',
    ),

    array(
      'id'      => 'opt-radio-6',
      'type'    => 'radio',
      'title'   => 'رادیو باتن دسته بندی ها وردپرس',
      'options' => 'categories',
    ),

  )
) );

//
// Repeater Fields
//
CSF::createSection( $prefix, array(
  'id'    => 'repeater_fields',
  'title' => 'فیلد های تکرار شونده',
  'icon'  => 'far fa-clone',
) );

//
// Field: repeater
//
CSF::createSection( $prefix, array(
  'parent'      => 'repeater_fields',
  'title'       => 'تکرار شونده ها',
  'description' => 'اطلاعات بیشتر در مورد فیلد های تکرار شونده: <a href="http://codestarframework.com/documentation/#/fields?id=repeater" target="_blank">تکرار شونده ها</a>',
  'fields'      => array(

    array(
      'id'     => 'opt-repeater-1',
      'type'   => 'repeater',
      'title'  => 'تکرار شونده',
      'fields' => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن'
        ),
      ),
    ),

    array(
      'id'     => 'opt-repeater-2',
      'type'   => 'repeater',
      'title'  => 'تکرار شونده با مقدار پیشفرض',
      'fields' => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
      ),
      'default' => array(
        array(
          'opt-text' => 'مقدار پیشفرض یک',
        ),
        array(
          'opt-text' => 'مقدار پیشفرض دوم',
        ),
      ),
    ),

    array(
      'id'     => 'opt-repeater-3',
      'type'   => 'repeater',
      'title'  => 'تکرار شونده ها با فیلد های چندتایی',
      'fields' => array(
        array(
          'id'    => 'opt-switcher',
          'type'  => 'switcher',
          'title' => 'سوئیچر',
        ),
        array(
          'id'    => 'opt-color',
          'type'  => 'color',
          'title' => 'رنگ',
        ),
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
      ),
      'default' => array(
        array(
          'opt-switcher' => false,
          'opt-color'    => '#3498db',
          'opt-text'     => 'متن پیشفرض',
        ),
      ),
    ),

    array(
      'id'           => 'opt-repeater-4',
      'type'         => 'repeater',
      'title'        => 'تکرار شونده با اعداد محدود',
      'subtitle'     => 'در این فیلد شما محدودیت اضافه کردن دارید (حداقل 1 / حداکثر 3)',
      'button_title' => 'افزودن متن',
      'min'          => 1,
      'max'          => 3,
      'fields'       => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
      ),
      'default' => array(
        array(
          'opt-text' => 'متن پیشفرض یک',
        ),
        array(
          'opt-text' => 'متن پیشفرض دو',
        ),
      ),
    ),

    array(
      'id'       => 'opt-repeater-6',
      'type'     => 'repeater',
      'title'    => 'تکرار شونده تودرتو',
      'subtitle' => 'شما می توانید بینهایت تکرارشونده تودرتو اضافه کنید',
      'fields'   => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'متن',
          'title' => 'Text',
        ),
        array(
          'id'     => 'opt-repeater-6-nested-1',
          'type'   => 'repeater',
          'title'  => 'تکرار شونده',
          'fields' => array(
            array(
              'id'    => 'opt-text',
              'type'  => 'text',
              'title' => 'متن'
            ),
          ),
        ),
      ),
      'default' => array(
        array(
          'opt-text' => 'متن پیشفرض یک',
          'opt-repeater-6-nested-1' => array(
            array(
              'opt-text' => 'متن پیشفرض یک',
            ),
            array(
              'opt-text' => 'متن پیشفرض دو',
            ),
          ),
        ),
      ),
    ),

  )
) );

//
// Field: group
//
CSF::createSection( $prefix, array(
  'parent'      => 'repeater_fields',
  'title'       => 'گروه های تکرار شونده',
  'description' => 'اطلاعات بیشتر در مورد گروه های تکرار شونده: <a href="http://codestarframework.com/documentation/#/fields?id=group" target="_blank">گروه های تکرار شونده</a>',
  'fields'      => array(

    array(
      'id'     => 'opt-group-1',
      'type'   => 'group',
      'title'  => 'گروه',
      'fields' => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'    => 'opt-switcher',
          'type'  => 'switcher',
          'title' => 'سوئیچر',
        ),
        array(
          'id'    => 'opt-textarea',
          'type'  => 'textarea',
          'title' => 'متن چندخطی',
        ),
      )
    ),

    array(
      'id'     => 'opt-group-2',
      'type'   => 'group',
      'title'  => 'گروه با مقدار پیشفرض',
      'fields' => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'    => 'opt-switcher',
          'type'  => 'switcher',
          'title' => 'سوئیچر',
        ),
        array(
          'id'    => 'opt-textarea',
          'type'  => 'textarea',
          'title' => 'متن چنخطی',
        ),
      ),
      'default' => array(
        array(
          'opt-text'     => 'متن شماره یک',
          'opt-switcher' => true,
          'opt-textarea' => 'متن چندخطی پیشفرض یک',
        ),
        array(
          'opt-text'     => 'متن شماره دو',
          'opt-switcher' => false,
          'opt-textarea' => 'متن چندخطی پیشفرض دو',
        ),
      )
    ),

    array(
      'id'       => 'opt-group-3',
      'type'     => 'group',
      'title'    => 'گروه تکرارشونده با اعداد محدود',
      'subtitle' => 'در این فیلد شما محدودیت اضافه کردن دارید (حداقل 1 / حداکثر 3)',
      'min'      => 1,
      'max'      => 3,
      'fields'   => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'    => 'opt-textarea',
          'type'  => 'textarea',
          'title' => 'متن چندخطی',
        ),
      ),
      'default' => array(
        array(
          'opt-text'     => 'متن محدود یک',
          'opt-textarea' => 'متن چندخطی محدود یک',
        ),
        array(
          'opt-text'     => 'متن محدود دو',
          'opt-textarea' => 'متن چندخطی محدود دو',
        ),
      )
    ),

    array(
      'id'       => 'opt-group-4',
      'type'     => 'group',
      'title'    => 'گروه با ادیتور پیشفرض وردپرس',
      'fields'   => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'    => 'opt-editor',
          'type'  => 'wp_editor',
          'title' => 'ویرایشگر وردپرس',
        ),
      ),
      'default' => array(
        array(
          'opt-text'   => 'ادیتور وردپرس یک',
          'opt-editor' => 'متن ادیتور وردپرس یک',
        ),
        array(
          'opt-text'   => 'ادیتور وردپرس دو',
          'opt-editor' => 'متن ادیتور وردپرس دو',
        ),
      )
    ),

    array(
      'id'       => 'opt-group-5',
      'type'     => 'group',
      'title'    => 'گروه تکرار شونده تودرتو',
      'subtitle' => 'شما می توانید بینهایت گروه تکرارشونده تودرتو اضافه کنید',
      'fields'   => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'     => 'opt-group-5-sublevel-1',
          'type'   => 'group',
          'title'  => 'گروه تودرتو',
          'fields' => array(
            array(
              'id'    => 'opt-text',
              'type'  => 'text',
              'title' => 'متن',
            ),
            array(
              'id'     => 'opt-group-5-sublevel-2',
              'type'   => 'group',
              'title'  => 'گروه تودرتو',
              'fields' => array(
                array(
                  'id'    => 'opt-text',
                  'type'  => 'text',
                  'title' => 'متن',
                ),
                array(
                  'id'    => 'opt-switcher',
                  'type'  => 'switcher',
                  'title' => 'سوئیچر',
                ),
                array(
                  'id'    => 'opt-textarea',
                  'type'  => 'textarea',
                  'title' => 'متن چندخطی',
                ),
              )
            ),
            array(
              'id'    => 'opt-switcher',
              'type'  => 'switcher',
              'title' => 'سوئیچر',
            ),
            array(
              'id'    => 'opt-textarea',
              'type'  => 'textarea',
              'title' => 'متن چندخطی',
            ),
          )
        ),
        array(
          'id'    => 'opt-switcher',
          'type'  => 'switcher',
          'title' => 'سوئیچر',
        ),
        array(
          'id'    => 'opt-textarea',
          'type'  => 'textarea',
          'title' => 'متن چندخطی',
        ),
      ),
      'default' => array(

        // top level defaults
        array(
          'opt-text' => 'سطح شماره یک',

          // sub level 1 defaults
          'opt-group-5-sublevel-1' => array(
            array(
              'opt-text' => 'زیرمجموعه یک',

              // sub level 2 defaults
              'opt-group-5-sublevel-2' => array(
                array(
                  'opt-text' => 'زیر زیرمجمعه یک',
                ),
                array(
                  'opt-text' => 'زیرزیرمجموعه دو',
                )
              ),
            ),
            array(
              'opt-text' => 'زیرمجموعه دو',
            )
          ),
        ),

        // top level defaults
        array(
          'opt-text' => 'سطح شماره دو',
        ),
      )
    ),

    array(
      'id'     => 'opt-group-6',
      'type'   => 'group',
      'title'  => 'گروه با فیلد تکرار شونده',
      'fields' => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'     => 'opt-group-6-repeater',
          'type'   => 'repeater',
          'title'  => 'تکرارشونده',
          'fields' => array(
            array(
              'id'    => 'opt-text',
              'type'  => 'text',
              'title' => 'متن'
            ),
          ),
        ),
        array(
          'id'    => 'opt-switcher',
          'type'  => 'switcher',
          'title' => 'سوئیچر',
        ),
        array(
          'id'    => 'opt-textarea',
          'type'  => 'textarea',
          'title' => 'متن چندخطی',
        ),
      ),
      'default' => array(
        array(
          'opt-text' => 'متن شماره یک',
          'opt-group-6-repeater' => array(
            array(
              'opt-text' => 'متن شماره یک',
            ),
              array(
              'opt-text' => 'متن شماره دو',
            ),
          )
        ),
      )
    ),

    array(
      'id'     => 'opt-group-7',
      'type'   => 'group',
      'title'  => 'گروه با امکان نمایش اولین فیلد به جای عنوان گروه ',
      'accordion_title_prefix' => 'Static Prefix:',
      'fields' => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'    => 'opt-switcher',
          'type'  => 'switcher',
          'title' => 'سوئیچر',
        ),
        array(
          'id'    => 'opt-textarea',
          'type'  => 'textarea',
          'title' => 'متن چندخطی',
        ),
      ),
      'default' => array(
        array(
          'opt-text'     => 'یک متن پیشفرض',
          'opt-switcher' => true,
          'opt-textarea' => 'متن چندخطی پیشفرض',
        ),
        array(
            'opt-text'     => ' یک متن پیشفرض دوم',
            'opt-switcher' => true,
            'opt-textarea' => 'متن چندخطی پیشفرض دوم',
        ),
      )
    ),

    array(
      'id'     => 'opt-group-8',
      'type'   => 'group',
      'title'  => 'گروه با امکان نمایش شماره گروه',
      'subtitle'  => 'accordion_title_number => true',
      'accordion_title_number' => true,
      'fields' => array(
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'    => 'opt-switcher',
          'type'  => 'switcher',
          'title' => 'سوئیچر',
        ),
        array(
          'id'    => 'opt-textarea',
          'type'  => 'textarea',
          'title' => 'متن چندخطی',
        ),
      ),
      'default' => array(
        array(
          'opt-text'     => 'متن پیشفرض یک',
          'opt-switcher' => true,
          'opt-textarea' => 'متن چندخطی شماره یک',
        ),
        array(
            'opt-text'     => 'متن پیشفرض دو',
            'opt-switcher' => true,
            'opt-textarea' => 'متن چندخطی شماره دو',
        ),
      )
    ),

  )
) );

//
// Combine Fields
//
CSF::createSection( $prefix, array(
  'id'    => 'combine_fields',
  'title' => 'فیلد های ترکیب شده',
  'icon'  => 'fas fa-bars',
) );

//
// Field: accordion
//
CSF::createSection( $prefix, array(
  'parent'      => 'combine_fields',
  'title'       => 'آکاردیون ها',
  'description' => 'اطلاعات بیشتر در مورد آکاردیون ها : <a href="http://codestarframework.com/documentation/#/fields?id=accordion" target="_blank">آکاردیون ها</a>',
  'fields'      => array(

    array(
      'id'         => 'opt-accordion-1',
      'type'       => 'accordion',
      'title'      => 'آکاردیون',
      'accordions' => array(

        array(
          'title'  => 'آکاردیون یک',
          'fields' => array(
            array(
              'id'    => 'opt-text-1',
              'type'  => 'text',
              'title' => 'متن',
            ),
            array(
              'id'    => 'opt-switcher-1',
              'type'  => 'switcher',
              'title' => 'سوئیچر',
            ),
            array(
              'id'    => 'opt-textarea-1',
              'type'  => 'textarea',
              'title' => 'متن چندخطی',
            ),
          )
        ),

        array(
          'title'  => 'آکاردیون دوم',
          'fields' => array(
            array(
              'id'    => 'opt-text-2',
              'type'  => 'text',
              'title' => 'متن',
            ),
            array(
              'id'    => 'opt-color-1',
              'type'  => 'color',
              'title' => 'رنگ',
            ),
          )
        ),

      )
    ),

    array(
      'id'         => 'opt-accordion-2',
      'type'       => 'accordion',
      'title'      => 'آکاردیون با مقدار پیشفرض',
      'accordions' => array(

        array(
          'title'  => 'فیلد یک',
          'fields' => array(
            array(
              'id'    => 'opt-text-1',
              'type'  => 'text',
              'title' => 'متن شماره یک',
            ),
            array(
              'id'    => 'opt-text-2',
              'type'  => 'text',
              'title' => 'متن شماره دو',
            ),
          )
        ),

        array(
          'title'  => 'فیلد دو',
          'fields' => array(
            array(
              'id'    => 'opt-color-1',
              'type'  => 'color',
              'title' => 'رنگ یک',
            ),
            array(
              'id'    => 'opt-color-2',
              'type'  => 'color',
              'title' => 'رنگ دو',
            ),
          )
        ),

        array(
          'title'  => 'فیلد سه',
          'fields' => array(
            array(
              'id'    => 'opt-textarea-1',
              'type'  => 'textarea',
              'title' => 'متن چندخطی',
            ),
            array(
              'id'    => 'opt-textarea-2',
              'type'  => 'textarea',
              'title' => 'متن چندخطی دو',
            ),
          )
        ),

      ),
      'default' => array(
        'opt-text-1'     => 'این مقدار اولیه متن شماره یک است',
        'opt-text-2'     => 'این مقدار اولیه متن شماره دو است',
        'opt-color-1'    => '#1e73be',
        'opt-color-2'    => '#ffbc00',
        'opt-textarea-1' => 'این مقدار اولیه متن چندخطی شماره یک است',
        'opt-textarea-2' => 'این مقدار اولیه متن چندخطی شماره دو است',
      )
    ),

    array(
      'id'         => 'accordion_3',
      'type'       => 'accordion',
      'title'      => 'آکاردیون با آیکن ',
      'accordions' => array(

        array(
          'title'  => 'آکاردیون یک',
          'icon'   => 'fas fa-check',
          'fields' => array(
            array(
              'id'    => 'opt-text-1',
              'type'  => 'text',
              'title' => 'متن یک',
            ),
          )
        ),

        array(
          'title'  => 'آکاردیون 2',
          'icon'   => 'fas fa-star',
          'fields' => array(
            array(
              'id'    => 'opt-text-2',
              'type'  => 'text',
              'title' => 'متن دو',
            ),
          )
        ),

      )
    ),

  )
) );

//
// Field: tabbed
//
CSF::createSection( $prefix, array(
  'parent'      => 'combine_fields',
  'title'       => 'تب بندی ها',
  'description' => 'اطلاعات بیشتر در مورد تب بندی ها : <a href="http://codestarframework.com/documentation/#/fields?id=tabbed" target="_blank">تب بندی ها</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-tabbed-1',
      'type'  => 'tabbed',
      'title' => 'تب بندی',
      'tabs'  => array(

        array(
          'title'  => 'تب شماره یک',
          'fields' => array(
            array(
              'id'    => 'opt-text-1',
              'type'  => 'text',
              'title' => 'متن شماره یک',
            ),
            array(
              'id'    => 'opt-textarea-1',
              'type'  => 'textarea',
              'title' => 'متن چندخطی شماره یک',
            ),
          ),
        ),

        array(
          'title'  => 'تب شماره دو',
          'fields' => array(
            array(
              'id'    => 'opt-text-2',
              'type'  => 'text',
              'title' => 'متن دو',
            ),
            array(
              'id'    => 'opt-textarea-2',
              'type'  => 'textarea',
              'title' => 'متن چندخطی دو',
            ),
          ),
        ),

      ),
    ),

    array(
      'id'    => 'opt-tabbed-2',
      'type'  => 'tabbed',
      'title' => 'تب بندی با مقدار پیشفرض و آیکن',
      'tabs'  => array(
        array(
          'title'  => 'فیلد شماره یک',
          'icon'   => 'fas fa-check',
          'fields' => array(
            array(
              'id'    => 'opt-text-1',
              'type'  => 'text',
              'title' => 'متن یک',
            ),
            array(
              'id'    => 'opt-text-2',
              'type'  => 'text',
              'title' => 'متن دو',
            ),
          ),
        ),
        array(
          'title'  => 'فیلد شماره دو',
          'icon'   => 'fas fa-star',
          'fields' => array(
            array(
              'id'      => 'opt-color-1',
              'type'    => 'color',
              'title'   => 'رنگ یک',
            ),
            array(
              'id'      => 'opt-color-2',
              'type'    => 'color',
              'title'   => 'رنگ دو',
            ),
          ),
        ),
        array(
          'title'  => 'فیلد شماره سه',
          'icon'   => 'fas fa-cog',
          'fields' => array(
            array(
              'id'    => 'opt-textarea-1',
              'type'  => 'textarea',
              'title' => 'متن چندخطی یک',
            ),
            array(
              'id'    => 'opt-textarea-2',
              'type'  => 'textarea',
              'title' => 'متن چندخطی شماره دو',
            ),
          ),
        ),
      ),
      'default' => array(
        'opt-text-1'     => 'این مقدار پیشفرض متن شماره یک است',
        'opt-text-2'     => 'این مقدار پیشفرض متن شماره دو است',
        'opt-color-1'    => '#1e73be',
        'opt-color-2'    => '#ffbc00',
        'opt-textarea-1' => 'این مقدار پیشفرض متن چندخطی شماره یک است',
        'opt-textarea-2' => 'این مقدار پیشفرض متن چندخطی شماره دو است',
      )
    ),

  )
) );

//
// Field: fieldset
//
CSF::createSection( $prefix, array(
  'parent' => 'combine_fields',
  'title'  => 'مجموعه ها',
  'fields' => array(

    array(
      'id'     => 'opt-fieldset-1',
      'type'   => 'fieldset',
      'title'  => 'مجموعه',
      'fields' => array(
        array(
          'id'    => 'opt-color',
          'type'  => 'color',
          'title' => 'رنگ',
        ),
        array(
          'id'    => 'opt-text',
          'type'  => 'text',
          'title' => 'متن',
        ),
        array(
          'id'    => 'opt-textarea',
          'type'  => 'textarea',
          'title' => 'متن چندخطی',
        ),
      ),
    ),

    array(
      'id'     => 'opt-fieldset-2',
      'type'   => 'fieldset',
      'title'  => 'مجموعه با مقدار پیشفرض',
      'fields' => array(
        array(
          'type'    => 'subheading',
          'content' => 'عنوان مجموعه',
        ),
        array(
          'id'      => 'opt-color',
          'type'    => 'color',
          'title'   => 'رنگ',
        ),
        array(
          'id'      => 'opt-text',
          'type'    => 'text',
          'title'   => 'متن',
        ),
        array(
          'id'      => 'opt-textarea',
          'type'    => 'textarea',
          'title'   => 'متن چندخطی',
        ),
      ),
      'default' => array(
        'opt-color'    => '#1e73be',
        'opt-text'     => 'This is text default value',
        'opt-textarea' => 'This is textarea default value',
      )
    ),

  )
) );

//
// Media and Upload Fields
//
CSF::createSection( $prefix, array(
  'id'    => 'media_fields',
  'title' => 'رسانه ها و فیلدهای آپلود',
  'icon'  => 'fas fa-upload',
) );

//
// Field: media
//
CSF::createSection( $prefix, array(
  'parent'      => 'media_fields',
  'title'       => 'رسانه',
  'description' => 'اطلاعات بیشتر در مورد رسانه ها: <a href="http://codestarframework.com/documentation/#/fields?id=media" target="_blank">رسانه ها</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-media-1',
      'type'  => 'media',
      'title' => 'رسانه',
    ),

    array(
      'id'      => 'opt-media-2',
      'type'    => 'media',
      'title'   => 'رسانه بدون پیشنمایش',
      'preview' => false,
    ),

    array(
      'id'    => 'opt-media-3',
      'type'  => 'media',
      'title' => 'رسانه بدون آدرس',
      'url'   => false,
    ),

    array(
      'id'      => 'opt-media-4',
      'type'    => 'media',
      'title'   => 'رسانه تصویری',
      'library' => 'image',
    ),

    array(
      'id'      => 'opt-media-5',
      'type'    => 'media',
      'title'   => 'رسانه ویدیویی',
      'library' => 'video',
    ),

    array(
      'id'      => 'opt-media-6',
      'type'    => 'media',
      'title'   => 'رسانه سوتی',
      'library' => 'audio',
    ),

  )
) );

//
// Field: upload
//
CSF::createSection( $prefix, array(
  'parent'      => 'media_fields',
  'title'       => 'آپلود',
  'description' => 'اطلاعات بیشتر در مرود آپلود : <a href="http://codestarframework.com/documentation/#/fields?id=upload" target="_blank">آپلود</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-upload-1',
      'type'  => 'upload',
      'title' => 'آپلود',
    ),

    array(
      'id'          => 'opt-upload-2',
      'type'        => 'upload',
      'title'       => 'آپلود با مقدار placeholder',
      'placeholder' => 'http://'
    ),

    array(
      'id'           => 'opt-upload-3',
      'type'         => 'upload',
      'title'        => 'آپلود فایل های تصویری',
      'library'      => 'image',
      'button_title' => 'آپلود عکس',
    ),

    array(
      'id'           => 'opt-upload-4',
      'type'         => 'upload',
      'title'        => 'آپلود فایل ویدیویی',
      'library'      => 'video',
      'button_title' => 'آپلود ویدیو',
    ),

    array(
      'id'           => 'opt-upload-5',
      'type'         => 'upload',
      'title'        => 'آپلود فایل صوتی',
      'library'      => 'audio',
      'button_title' => 'آپلود صوت',
    ),

  )
) );

//
// Field: gallery
//
CSF::createSection( $prefix, array(
  'parent'      => 'media_fields',
  'title'       => 'گالری',
  'description' => 'اطلاعات بیشتر در مورد گالری : <a href="http://codestarframework.com/documentation/#/fields?id=gallery" target="_blank">گالری</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-gallery-1',
      'type'  => 'gallery',
      'title' => 'گالری',
    ),

    array(
      'id'          => 'opt-gallery-2',
      'type'        => 'gallery',
      'title'       => 'گالری با عنوان شخصی ',
      'add_title'   => 'افزودن عکس',
      'edit_title'  => 'ویرایش عکس',
      'clear_title' => 'حذف عکس',
    ),

  )
) );

//
// Editor Fields
//
CSF::createSection( $prefix, array(
  'id'    => 'editor_fields',
  'title' => 'ویرایشگر کد',
  'icon'  => 'fas fa-code',
) );

//
// Field: code_editor
//
CSF::createSection( $prefix, array(
  'parent'      => 'editor_fields',
  'title'       => 'ویرایشگر کد',
  'description' => 'اطلاعات بیشتر در مورد ویرایشگر کد : <a href="http://codestarframework.com/documentation/#/fields?id=code-editor" target="_blank">ویرایشگر کد</a>',
  'fields'      => array(

    array(
      'id'       => 'opt-code-editor-1',
      'type'     => 'code_editor',
      'title'    => 'ویرایشگر کد',
      'subtitle' => '<strong>ویرایشگر پیشفرض</strong> ویرایشگر کد های html',
    ),

    array(
      'id'       => 'code_editor_2',
      'type'     => 'code_editor',
      'title'    => 'ویرایشگر کد',
      'subtitle' => '<strong>ویرایشگر html</strong> جهت ویرایش و اضافه کردن کدهای html',
      'settings' => array(
        'theme'  => 'shadowfox',
        'mode'   => 'htmlmixed',
      ),
      'default'  =>'<div class="wrapper">
  <h1>Hello world</h1>
  <p>Lorem <strong>ipsum</strong> dollar.</p>
</div>',
    ),

    array(
      'id'       => 'opt-code-editor-2',
      'type'     => 'code_editor',
      'title'    => 'ویرایشگر کد',
      'subtitle' => '<strong>ویرایشگر js</strong> جهت ویرایش کدهای jquery',
      'settings' => array(
        'theme'  => 'dracula',
        'mode'   => 'javascript',
      ),
      'default' =>';(function( $, window, document, undefined ) {
  "use strict";

  $(document).ready( function() {

    // do stuff

  });

})( jQuery, window, document );',
    ),

    array(
      'id'       => 'opt-code-editor-3',
      'type'     => 'code_editor',
      'desc'     => '<strong>ویرایشگر css</strong> ویرایشگر کدهای css',
      'settings' => array(
        'theme'  => 'mbo',
        'mode'   => 'css',
      ),
      'default' =>'.wrapper {
  font-family: "Open Sans";
  font-size: 13px;
  width: 250px;
  height: 100px;
  color: #fff;
  background-color: #555;
}',
    ),

  )
) );

//
// Field: wp_editor
//
CSF::createSection( $prefix, array(
  'parent'      => 'editor_fields',
  'title'       => 'ویرایشگر پیشفرض وردپرس',
  'description' => 'اطلاعات بیشتر در مورد ویراشکر پیشفرض وردپرس: <a href="http://codestarframework.com/documentation/#/fields?id=wp-editor" target="_blank">ویرایشگر پیشفرض وردپرس</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-wp-editor-1',
      'type'  => 'wp_editor',
      'title' => 'ویرایشگر وردپرس',
    ),

    array(
      'id'            => 'opt-wp-editor-2',
      'type'          => 'wp_editor',
      'title'         => 'ویرایشگر وردپرس با ارتفاع قابل تنظیم و بدون دکمه رسانه ها',
      'subtitle'      => 'Settings:<br />height => 100px,<br />media_buttons => false',
      'height'        => '100px',
      'media_buttons' => false,
    ),

    array(
      'id'            => 'opt-wp-editor-3',
      'type'          => 'wp_editor',
      'title'         => 'ویرایشگر وردپرس بدون دکمه های دیداری و متن',
      'subtitle'      => 'Settings:<br />height => 100px,<br />media_buttons => false,<br />quicktags => false',
      'height'        => '100px',
      'media_buttons' => false,
      'quicktags'     => false,
    ),

    array(
      'id'            => 'opt-wp-editor-4',
      'type'          => 'wp_editor',
      'title'         => 'ویرایشگر وردپرس با حالت ساده',
      'subtitle'      => 'Settings:<br />height => 100px,<br />media_buttons => false,<br />tinymce => false',
      'height'        => '100px',
      'media_buttons' => false,
      'tinymce'       => false,
    ),

  )
) );

//
// Color Fields
//
CSF::createSection( $prefix, array(
  'id'    => 'color_fields',
  'title' => 'فیلد های رنگ',
  'icon'  => 'fas fa-tint',
) );

//
// Field: color
//
CSF::createSection( $prefix, array(
  'parent'      => 'color_fields',
  'title'       => 'رنگ',
  'description' => 'اطلاعات بیشتر در مورد فیلد های رنگ: <a href="http://codestarframework.com/documentation/#/fields?id=color" target="_blank">رنگ</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-color-1',
      'type'  => 'color',
      'title' => 'رنگ',
    ),

    array(
      'id'      => 'opt-color-2',
      'type'    => 'color',
      'title'   => 'رنگ با مقدار پیشفرض (hex)',
      'default' => '#3498db',
    ),

    array(
      'id'      => 'opt-color-3',
      'type'    => 'color',
      'title'   => 'رنگ با مقدار پیشفرض (rgba)',
      'default' => 'rgba(255,255,0,0.25)',
    ),

    array(
      'id'      => 'opt-color-4',
      'type'    => 'color',
      'title'   => 'رنگ با مقدار پیشفرض (transparent)',
      'default' => 'transparent',
    ),

  )
) );

//
// Field: link_color
//
CSF::createSection( $prefix, array(
  'parent'      => 'color_fields',
  'title'       => 'رنگ لینک ها',
  'description' => 'اطلاعات بیشتر در مورد رنگ لینک ها : <a href="http://codestarframework.com/documentation/#/fields?id=link-color" target="_blank">رنگ لینک ها</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-link-color-1',
      'type'  => 'link_color',
      'title' => 'رنگ لینک',
    ),

    array(
      'id'      => 'opt-link-color-2',
      'type'    => 'link_color',
      'title'   => 'رنگ با مقدار پیشفرض',
      'default' => array(
        'color' => '#1e73be',
        'hover' => '#259ded',
      ),
    ),

    array(
      'id'      => 'opt-link-color-3',
      'type'    => 'link_color',
      'title'   => 'رنگ لینک ها با تنظیمات بیشتر',
      'color'   => true,
      'hover'   => true,
      'visited' => true,
      'active'  => true,
      'focus'   => true,
    ),

  )
) );

//
// Field: color_group
//
CSF::createSection( $prefix, array(
  'parent'      => 'color_fields',
  'title'       => 'گروه رنگ ها',
  'description' => 'اطلاعات بیشتر در مورد گروه رنگ ها : <a href="http://codestarframework.com/documentation/#/fields?id=color-group" target="_blank">گروه رنگ ها</a>',
  'fields'      => array(

    array(
      'id'        => 'opt-color-group-1',
      'type'      => 'color_group',
      'title'     => 'گروه رنگ',
      'options'   => array(
        'color-1' => 'رنگ 1',
        'color-2' => 'رنگ 2',
      )
    ),

    array(
      'id'        => 'opt-color-group-2',
      'type'      => 'color_group',
      'title'     => 'گروه رنگ ',
      'options'   => array(
        'color-1' => 'رنگ 1',
        'color-2' => 'رنگ 2',
        'color-3' => 'رنگ 3',
      )
    ),

    array(
      'id'        => 'opt-color-group-3',
      'type'      => 'color_group',
      'title'     => 'گروه رنگ با مقدار پیشفرض',
      'subtitle'  => 'شما می توانید رنگ های بیشتری اضافه کنید.',
      'options'   => array(
          'color-1' => 'رنگ 1',
          'color-2' => 'رنگ 2',
          'color-3' => 'رنگ 3',
        'color-4' => 'رنگ 4',
        'color-5' => 'رنگ 5',
      ),
      'default'   => array(
        'color-1' => '#000100',
        'color-2' => '#002642',
        'color-3' => '#ffce4b',
        'color-4' => '#ff595e',
        'color-5' => '#0052cc',
      )
    ),

  )
) );

//
// Field: palette
//
CSF::createSection( $prefix, array(
  'parent'      => 'color_fields',
  'title'       => 'پلت رنگ',
  'description' => 'اطلاعات بیشتر در مرود پلت رنگ : <a href="http://codestarframework.com/documentation/#/fields?id=palette" target="_blank">پلت رنگ</a>',
  'fields'      => array(

    array(
      'id'       => 'opt-palette-1',
      'type'     => 'palette',
      'title'    => 'پلت رنگ',
      'subtitle' => 'پلت رنگ سه تایی',
      'options'  => array(
        'set-1'  => array( '#f36e27', '#f3d430', '#ed1683' ),
        'set-2'  => array( '#4153ab', '#6e86c7', '#211f27' ),
        'set-3'  => array( '#162526', '#508486', '#C8C6CE' ),
        'set-4'  => array( '#ccab5e', '#fff55f', '#197c5d' ),
      ),
      'default'  => 'set-1',
    ),

    array(
      'id'       => 'opt-palette-1',
      'type'     => 'palette',
      'title'    => 'پلت رنگ',
      'subtitle' => 'پلت رنگ چهارتایی',
      'options'  => array(
        'set-1'  => array( '#f04e36', '#f36e27', '#f3d430', '#ed1683' ),
        'set-2'  => array( '#f9ca06', '#b5b546', '#2f4d48', '#212b2f' ),
        'set-3'  => array( '#4153ab', '#6e86c7', '#211f27', '#d69762' ),
        'set-4'  => array( '#162526', '#508486', '#C8C6CE', '#B45F1A' ),
        'set-5'  => array( '#bbd5ff', '#ccab5e', '#fff55f', '#197c5d' ),
      ),
      'default'  => 'set-3',
    ),

    array(
      'id'       => 'opt-palette-2',
      'type'     => 'palette',
      'title'    => 'پلت رنگ',
      'subtitle' => 'پلت رنگ پنج تایی',
      'options'  => array(
        'set-1'  => array( '#bbd5ff', '#ccab5e', '#fff55f', '#197c5d', '#bce2c4' ),
        'set-2'  => array( '#6d3264', '#edf7f6', '#fde8e9', '#006675', '#e49ab0' ),
        'set-3'  => array( '#000100', '#002642', '#ffce4b', '#ff595e', '#0052cc' ),
      ),
      'default'  => 'set-1',
    ),

  )
) );

//
// Design Fields
//
CSF::createSection( $prefix, array(
  'id'    => 'design_fields',
  'title' => 'فیلدهای طراحی',
  'icon'  => 'fas fa-adjust',
) );

//
// Field: background
//
CSF::createSection( $prefix, array(
  'parent'      => 'design_fields',
  'title'       => 'پس زمینه ها',
  'description' => 'اطلاعات بیشتر در مرود پس زمینه ها: <a href="http://codestarframework.com/documentation/#/fields?id=background" target="_blank">پس زمینه ها</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-background-1',
      'type'  => 'background',
      'title' => 'پس زمینه',
    ),

    array(
      'id'      => 'opt-background-2',
      'type'    => 'background',
      'title'   => 'پس زمینه با مقدار پیش فرض',
      'default' => array(
        'background-color'      => '#e80000',
        'background-position'   => 'center center',
        'background-repeat'     => 'repeat-x',
        'background-attachment' => 'fixed',
        'background-size'       => 'cover',
      )
    ),

    array(
      'id'                    => 'opt-background-3',
      'type'                  => 'background',
      'title'                 => 'پس زمینه با همه ویژگی ها',
      'background_color'      => true,
      'background_image'      => true,
      'background-position'   => true,
      'background_repeat'     => true,
      'background_attachment' => true,
      'background_size'       => true,
      'background_origin'     => true,
      'background_clip'       => true,
      'background_blend_mode' => true,
      'background_gradient'   => true,
      'default'               => array(
        'background-color'              => '#009e44',
        'background-gradient-color'     => '#81d742',
        'background-gradient-direction' => '135deg',
        'background-position'           => 'center center',
        'background-repeat'             => 'repeat-x',
        'background-attachment'         => 'fixed',
        'background-size'               => 'cover',
        'background-origin'             => 'border-box',
        'background-clip'               => 'padding-box',
        'background-blend-mode'         => 'normal',
      )
    ),

  )
) );

//
// Field: typography
//
CSF::createSection( $prefix, array(
  'parent'      => 'design_fields',
  'title'       => 'تایپوگرافی',
  'description' => 'اطلاعات بیشتر در مرود تایپوگرافی: <a href="http://codestarframework.com/documentation/#/fields?id=typography" target="_blank">تایپوگرافی</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-typography-1',
      'type'  => 'typography',
      'title' => 'تایپوگرافی',
    ),

    array(
      'id'               => 'opt-typography-2',
      'type'             => 'typography',
      'title'            => 'تایپوگرافی با مقدار پیشفرض',
      'default'          => array(
        'font-family'    => 'Barlow',
        'font-weight'    => '600',
        'subset'         => 'latin-ext',
        'type'           => 'google',
        'text-align'     => 'center',
        'text-transform' => 'capitalize',
        'text-transform' => 'capitalize',
        'font-size'      => '18',
        'line-height'    => '20',
        'letter-spacing' => '-1',
        'color'          => '#009e44',
      ),
    ),

    array(
      'id'             => 'opt-typography-3',
      'type'           => 'typography',
      'title'          => 'تایپوگرافی با چند ویژگی',
      'text_align'     => false,
      'text_transform' => false,
      'font_size'      => false,
      'line_height'    => false,
      'letter_spacing' => false,
      'color'          => false,
      'default'        => array(
        'font-family'  => 'Lato',
        'font-weight'  => '900',
        'subset'       => 'latin',
        'type'         => 'google',
      ),
    ),


    array(
      'id'                 => 'opt-typography-4',
      'type'               => 'typography',
      'title'              => 'تایپوگرافی با تمامی ویژگی ها',
      'font_family'        => true,
      'font_weight'        => true,
      'font_style'         => true,
      'font_size'          => true,
      'line_height'        => true,
      'letter_spacing'     => true,
      'text_align'         => true,
      'text-transform'     => true,
      'color'              => true,
      'subset'             => true,
      'backup_font_family' => true,
      'font_variant'       => true,
      'word_spacing'       => true,
      'text_decoration'    => true,
      'default'            => array(
        'font-family'      => 'Old Standard TT',
        'type'             => 'google',
      ),
    ),

  )
) );

//
// Field: dimensions
//
CSF::createSection( $prefix, array(
  'parent'      => 'design_fields',
  'title'       => 'ابعاد',
  'description' => 'اطلاعات بیشتر در مورد ابعاد: <a href="http://codestarframework.com/documentation/#/fields?id=dimensions" target="_blank">ابعاد</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-dimensions-1',
      'type'  => 'dimensions',
      'title' => 'ابعاد',
    ),

    array(
      'id'       => 'opt-dimensions-2',
      'type'     => 'dimensions',
      'title'    => 'ابعاد با مقدار پیشفرض',
      'default'  => array(
        'width'  => '100',
        'height' => '250',
        'unit'   => 'px',
      ),
    ),

    array(
      'id'          => 'opt-dimensions-3',
      'type'        => 'dimensions',
      'title'       => 'ابعاد با متن و مقادیر دلخواه',
      'width_icon'  => 'عرض',
      'height_icon' => 'ارتفاع',
      'units'       => array( 'px', '%', 'em', 'rem', 'pt' ),
      'default'     => array(
        'width'     => '100',
        'height'    => '50',
        'unit'      => '%',
      ),
    ),

    array(
      'id'    => 'opt-dimensions-4',
      'type'  => 'dimensions',
      'title' => 'ابعاد با یک مقدار',
      'units' => array( 'px' ),
    ),

    array(
      'id'    => 'opt-dimensions-5',
      'type'  => 'dimensions',
      'title' => 'ابعاد بدون امکان انتخاب مقدار',
      'unit'  => false,
    ),

    array(
      'id'     => 'opt-dimensions-6',
      'type'   => 'dimensions',
      'title'  => 'ابعاد با مقدار عرض',
      'height' => false,
    ),

    array(
      'id'     => 'opt-dimensions-7',
      'type'   => 'dimensions',
      'title'  => 'ابعاد با مقدار عرض و پیکسل',
      'height' => false,
      'units'  => array( 'px' ),
    ),

  )
) );

//
// Field: spacing
//
CSF::createSection( $prefix, array(
  'parent'      => 'design_fields',
  'title'       => 'فاصله ها',
  'description' => ' اطلاعات بیشتر در مورد فاصله ها: <a href="http://codestarframework.com/documentation/#/fields?id=spacing" target="_blank">فاصله ها</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-spacing-1',
      'type'  => 'spacing',
      'title' => 'فاصله',
    ),

    array(
      'id'       => 'opt-spacing-2',
      'type'     => 'spacing',
      'title'    => 'فاصله با مقادیر پیشفرض',
      'default'  => array(
        'top'    => '50',
        'right'  => '100',
        'bottom' => '50',
        'left'   => '100',
        'unit'   => 'px',
      ),
    ),

    array(
      'id'       => 'opt-spacing-2',
      'type'     => 'spacing',
      'title'    => 'فاصله بدون انتخاب مقادیر',
      'units'    => array( 'px' ),
      'default'  => array(
        'top'    => '50',
        'right'  => '100',
        'bottom' => '50',
        'left'   => '100',
        'unit'   => 'px',
      ),
    ),

    array(
      'id'     => 'opt-spacing-3',
      'type'   => 'spacing',
      'title'  => 'فاصله برای راست و چپ',
      'top'    => false,
      'bottom' => false,
    ),

    array(
      'id'    => 'opt-spacing-4',
      'type'  => 'spacing',
      'title' => 'فاصله برای بالا و پائین',
      'left'  => false,
      'right' => false,
    ),

    array(
      'id'    => 'opt-spacing-5',
      'type'  => 'spacing',
      'title' => 'فاصله برای تمامی جهت ها',
      'all'   => true,
    ),

  )
) );

//
// Field: border
//
CSF::createSection( $prefix, array(
  'parent'      => 'design_fields',
  'title'       => 'بوردر',
  'description' => 'اطلاعات بیشتر در مورد بوردر : <a href="http://codestarframework.com/documentation/#/fields?id=border" target="_blank">بوردر</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-border-1',
      'type'  => 'border',
      'title' => 'بوردر',
    ),

    array(
      'id'       => 'opt-border-2',
      'type'     => 'border',
      'title'    => 'بوردر با مقدار پیشفرض',
      'default'  => array(
        'top'    => '4',
        'right'  => '8',
        'bottom' => '4',
        'left'   => '8',
        'style'  => 'dashed',
        'color'  => '#1e73be',
      )
    ),

    array(
      'id'     => 'opt-border-3',
      'type'   => 'border',
      'title'  => 'اندازه بورد برای راست و چپ',
      'top'    => false,
      'bottom' => false,
    ),

    array(
      'id'    => 'opt-border-4',
      'type'  => 'border',
      'title' => 'اندازه بورد برای بالا و پائین ',
      'left'  => false,
      'right' => false,
    ),

    array(
      'id'    => 'opt-border-5',
      'type'  => 'border',
      'title' => 'بوردر برای تمایم جهات',
      'all'   => true,
    ),

  )
) );

//
// Field: spinner
//
CSF::createSection( $prefix, array(
  'parent'      => 'design_fields',
  'title'       => 'چرخنده ها',
  'description' => 'اطلاعات بیشتر در مورد چرخنده ها : <a href="http://codestarframework.com/documentation/#/fields?id=spinner" target="_blank">چرخنده ها</a>',
  'fields'      => array(

    array(
      'id'       => 'opt-spinner-1',
      'type'     => 'spinner',
      'title'    => 'چرخنده',
      'subtitle' => 'حداکثر :100 | حداقل :0 | گام :1',
      'max'      => 100,
      'min'      => 0,
      'step'     => 1,
      'default'  => 25,
    ),

    array(
      'id'       => 'opt-spinner-2',
      'type'     => 'spinner',
      'title'    => 'چرخنده',
        'subtitle' => 'حداکثر :200 | حداقل :100 | گام :10',
      'max'      => 200,
      'min'      => 100,
      'step'     => 10,
      'default'  => 100,
    ),

    array(
      'id'       => 'opt-spinner-3',
      'type'     => 'spinner',
      'title'    => 'چرخنده',
      'subtitle' => 'حداکثر:1 | حداکقل:0 | گام:0.1 | مقدار:px',
      'max'      => 1,
      'min'      => 0,
      'step'     => 0.1,
      'unit'     => 'px',
      'default'  => 0.5,
    ),

  )
) );

//
// Field: number
//
CSF::createSection( $prefix, array(
  'parent'      => 'design_fields',
  'title'       => 'اعداد',
  'description' => 'اطلاعات بیشتر در مورد اعداد : <a href="http://codestarframework.com/documentation/#/fields?id=number" target="_blank">اعداد </a>',
  'fields'      => array(

    array(
      'id'      => 'opt-number-1',
      'type'    => 'number',
      'title'   => 'عدد',
    ),
    array(
      'id'      => 'opt-number-2',
      'type'    => 'number',
      'title'   => 'عدد با مقدار',
      'unit'    => 'px',
    ),
    array(
      'id'      => 'opt-number-3',
      'type'    => 'number',
      'title'   => 'عدد با مقدار پیشفرض',
      'unit'    => 'width',
      'default' => 100,
    ),

  )
) );

//
// Additional Fields
//
CSF::createSection( $prefix, array(
  'id'    => 'additional_fields',
  'title' => 'زمینه های اضافی',
  'icon'  => 'fas fa-asterisk',
) );

//
// Field: slider
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'اسلایدر',
  'icon'        => 'fas fa-sliders-h',
  'description' => 'اطلاعات بیشتر در مورد اسلایدر ها: <a href="http://codestarframework.com/documentation/#/fields?id=slider" target="_blank">اسلایدر</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-slider-1',
      'type'  => 'slider',
      'title' => 'اسلایدر',
    ),

    array(
      'id'      => 'opt-slider-2',
      'type'    => 'slider',
      'title'   => 'اسلایدر با مقدار پیشفرض',
      'default' => 50,
    ),

    array(
      'id'      => 'opt-slider-3',
      'type'    => 'slider',
      'title'   => 'اسلایدر متن مقدار دلخواه',
      'unit'    => '%',
      'default' => 75,
    ),

    array(
      'id'       => 'opt-slider-4',
      'type'     => 'slider',
      'title'    => 'اسلایدر با امکان تائین حداقل و حداکثر',
      'subtitle' => 'حداقل: 1 | حداکثر: 10 | گام: 0.1 | پیشفرض: 5.5',
      'unit'     => 'px',
      'min'      => 1,
      'max'      => 10,
      'step'     => 0.1,
      'default'  => 5.5,
    ),

  )
) );

//
// Field: sorter
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'مرتب ساز',
  'icon'        => 'fas fa-sort-numeric-down',
  'description' => 'اطلاعات بیشتر در مورد مرتب ساز : <a href="http://codestarframework.com/documentation/#/fields?id=sorter" target="_blank">مرتب ساز</a>',
  'fields'      => array(

    array(
      'id'         => 'opt-sorter-1',
      'type'       => 'sorter',
      'title'      => 'مرتب ساز',
      'default'    => array(
        'enabled'  => array(
          'opt-1'  => 'گزینه اول',
          'opt-2'  => 'گزینه دوم',
          'opt-3'  => 'گزینه سوم',
        ),
        'disabled' => array(
          'opt-4'  => 'گزینه چهارم',
          'opt-5'  => 'گزینه پنجم',
        ),
      ),
    ),

    array(
      'id'             => 'opt-sorter-2',
      'type'           => 'sorter',
      'title'          => 'مرتب ساز باعنوان سخصی',
      'enabled_title'  => 'فعال شده',
      'disabled_title' => 'غیرفعال شده',
      'default'        => array(
        'enabled'      => array(
            'opt-1'  => 'گزینه اول',
            'opt-2'  => 'گزینه دوم',
            'opt-3'  => 'گزینه سوم',
        ),
        'disabled'     => array(
            'opt-4'  => 'گزینه چهارم',
            'opt-5'  => 'گزینه پنجم',
        ),
      ),
    ),

    array(
      'id'            => 'opt-sorter-3',
      'type'          => 'sorter',
      'title'         => 'مرتب ساز قسمت فعال بدون عنوان',
      'enabled_title' => false,
      'disabled'      => false,
      'default'       => array(
        'enabled'     => array(
            'opt-1'  => 'گزینه اول',
            'opt-2'  => 'گزینه دوم',
            'opt-3'  => 'گزینه سوم',
        ),
      ),
    ),

  )
) );

//
// Field: sortable
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'قابل مرتب سازی',
  'icon'        => 'fas fa-arrows-alt',
  'description' => 'اطلاعات بیشتر در مورد فیلد های قالب مرتب سازی: <a href="http://codestarframework.com/documentation/#/fields?id=sortable" target="_blank">Field: sortable</a>',
  'fields'      => array(

    array(
      'id'           => 'opt-sortable-1',
      'type'         => 'sortable',
      'title'        => 'فیلد های قابل مرتب سازی',
      'fields'       => array(
        array(
          'id'       => 'opt-text-1',
          'type'     => 'text',
          'title'    => 'متن یک'
        ),
        array(
          'id'       => 'opt-text-2',
          'type'     => 'text',
          'title'    => 'متن دو'
        ),
        array(
          'id'       => 'opt-text-3',
          'type'     => 'text',
          'title'    => 'متن سه'
        ),
      ),
    ),

    array(
      'id'           => 'opt-sortable-2',
      'type'         => 'sortable',
      'title'        => 'فیلدهای قابل مرتب سازی با مقدار پیشفرض ',
      'fields'       => array(
        array(
          'id'       => 'opt-text-1',
          'type'     => 'text',
          'title'    => 'متن یک'
        ),
        array(
          'id'       => 'opt-text-2',
          'type'     => 'text',
          'title'    => 'متن دو'
        ),
        array(
          'id'       => 'opt-text-3',
          'type'     => 'text',
          'title'    => 'متن سه'
        ),
      ),
      'default'      => array(
        'opt-text-1' => 'متن پیشفرض یک',
        'opt-text-2' => 'متن پیشفرض دو',
        'opt-text-3' => 'متن پیشفرض سه',
      )
    ),

  )
) );

//
// Field: switcher
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'سوئیچر ها',
  'icon'        => 'fas fa-toggle-on',
  'description' => 'اطلاعات بیشتر در مورد سوئیچر ها : <a href="http://codestarframework.com/documentation/#/fields?id=switcher" target="_blank">سوئیچر</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-switcher-1',
      'type'  => 'switcher',
      'title' => 'سوئیچر',
    ),

    array(
      'id'      => 'opt-switcher-2',
      'type'    => 'switcher',
      'title'   => 'سوئیچر با مقدار پیشفرض',
      'default' => true,
    ),

    array(
      'id'    => 'opt-switcher-3',
      'type'  => 'switcher',
      'title' => 'سوئیچر به همراه لیبل',
      'label' => 'متن لیبل مربوط به لیبل',
    ),

    array(
      'id'       => 'opt-switcher-4',
      'type'     => 'switcher',
      'title'    => 'سوئیچر با بله / خیر',
      'text_on'  => 'بله',
      'text_off' => 'خیر',
    ),

    array(
      'id'         => 'opt-switcher-4',
      'type'       => 'switcher',
      'title'      => 'سوئیچر با متن شخصی سازی شده ',
      'text_on'    => 'فعال',
      'text_off'   => 'غیرفعال',
      'text_width' => '100',
    ),

  )
) );

//
// Field: icons
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'آیکن ها',
  'icon'        => 'fas fa-star',
  'description' => 'اطلاعات بیشتر در مورد آیکن ها : <a href="http://codestarframework.com/documentation/#/fields?id=icon" target="_blank">آیکن ها </a>',
  'fields'      => array(

    array(
      'id'    => 'opt-icon-1',
      'type'  => 'icon',
      'title' => 'آیکن ',
    ),

    array(
      'id'      => 'opt-icon-2',
      'type'    => 'icon',
      'title'   => 'آیکن با مقدار پیشفرض',
      'default' => 'fas fa-check',
    ),

  )
) );

//
// Field: map
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'نقشه',
  'icon'        => 'fas fa-map-marker',
  'description' => 'اطلاعات بیشتر در مورد نقشه ها : <a href="http://codestarframework.com/documentation/#/fields?id=map" target="_blank">نقشه ها</a>',
  'fields'      => array(

    array(
      'id'            => 'opt-map-1',
      'type'          => 'map',
      'title'         => 'نقشه',
    ),

    array(
      'id'            => 'opt-map-2',
      'type'          => 'map',
      'title'         => 'نقشه با مقدار پیشفرض',
      'default'       => array(
        'address'     => 'New York, United States of America',
        'latitude'    => '40.7127281',
        'longitude'   => '-74.0060152',
        'zoom'        => '12',
      )
    ),

    array(
      'type'          => 'submessage',
      'style'         => 'info',
      'content'       => 'امکان وارد کردن  <strong>آدرس دلخوا</strong> .',
    ),

    array(
      'id'            => 'my-address-text',
      'type'          => 'text',
      'title'         => 'آدرس',
    ),

    array(
      'id'            => 'opt-map-3',
      'type'          => 'map',
      'title'         => 'نقشه',
      'desc'          => 'استفاده از  <strong>فیلد آدرس </strong> سفارشی ',
      'address_field' => 'my-address-text',
    ),

  )
) );

//
// Field: link
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'لینک',
  'icon'        => 'fas fa-link',
  'description' => 'اطلاعات بشتر در مورد لینک : <a href="http://codestarframework.com/documentation/#/fields?id=link" target="_blank">: لینک </a>',
  'fields'      => array(

    array(
      'id'    => 'opt-link-1',
      'type'  => 'link',
      'title' => 'لینک',
    ),

    array(
      'id'       => 'opt-link-2',
      'type'     => 'link',
      'title'    => 'لینک با مقدار پیشفرض',
      'default'  => array(
        'url'    => 'http://codestarframework.com/',
        'text'   => 'Codestar Framework',
        'target' => '_blank'
      ),
    ),

  )
) );

//
// Field: date
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'تاریخ',
  'icon'        => 'fas fa-calendar',
  'description' => 'اطلاعات بیشتر در مورد انتخاب گر تاریخ: <a href="http://codestarframework.com/documentation/#/fields?id=date" target="_blank">تاریخ</a>',
  'fields'      => array(

    array(
      'id'    => 'opt-date-1',
      'type'  => 'date',
      'title' => 'تاریخ',
    ),

    array(
      'id'       => 'opt-date-2',
      'type'     => 'date',
      'title'    => 'تاریخ با مقدار پیشفرض',
      'settings' => array(
        'dateFormat'      => 'mm/dd/yy',
        'changeMonth'     => true,
        'changeYear'      => true,
        'showWeek'        => true,
        'showButtonPanel' => true,
        'weekHeader'      => 'Week',
        'monthNamesShort' => array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ),
        'dayNamesMin'     => array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ),
      )
    ),

    array(
      'id'      => 'opt-date-3',
      'type'    => 'date',
      'title'   => 'تاریخ با فرمت از ، تا ',
      'from_to' => true,
    ),

    array(
      'id'        => 'opt-date-4',
      'type'      => 'date',
      'title'     => 'تاریخ با عنوان شخصی سازی شده',
      'from_to'   => true,
      'text_from' => 'شروع',
      'text_to'   => 'پایان',
    ),

  )
) );

//
// Field: image_select
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'انتخاب گر عکس',
  'icon'        => 'fas fa-th',
  'description' => 'اطلاعات بیشتر در مورد انتخاب گر عکس : <a href="http://codestarframework.com/documentation/#/fields?id=image-select" target="_blank">انتخاب گر عکس</a>',
  'fields'      => array(

    array(
      'id'      => 'opt-image-select-1',
      'type'    => 'image_select',
      'title'   => 'انتخاب عکس',
      'options' => array(
        'opt-1' => 'http://codestarframework.com/assets/images/placeholder/150x125-2ecc71.gif',
        'opt-2' => 'http://codestarframework.com/assets/images/placeholder/150x125-e74c3c.gif',
        'opt-3' => 'http://codestarframework.com/assets/images/placeholder/150x125-ffbc00.gif',
        'opt-4' => 'http://codestarframework.com/assets/images/placeholder/150x125-3498db.gif',
      ),
    ),

    array(
      'id'      => 'opt-image-select-2',
      'type'    => 'image_select',
      'title'   => 'انتخاب عکس با مقدار پیشفرض',
      'options' => array(
        'opt-1' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-2' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-3' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-4' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-5' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-6' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-7' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
      ),
      'default' => 'opt-4'
    ),

    array(
      'id'       => 'opt-image-select-3',
      'type'     => 'image_select',
      'title'    => 'انتخاب عکس با امکان انتخاب چندگانه',
      'multiple' => true,
      'options'  => array(
        'opt-1'  => 'http://codestarframework.com/assets/images/placeholder/80x80-e74c3c.gif',
        'opt-2'  => 'http://codestarframework.com/assets/images/placeholder/80x80-ffbc00.gif',
        'opt-3'  => 'http://codestarframework.com/assets/images/placeholder/80x80-3498db.gif',
        'opt-4'  => 'http://codestarframework.com/assets/images/placeholder/80x80-2ecc71.gif',
      ),
    ),

    array(
      'id'       => 'opt-image-select-4',
      'type'     => 'image_select',
      'title'    => 'انتخاب عکس با مقدار پیشفرض و انتخاب چندگانه',
      'multiple' => true,
      'options'  => array(
        'opt-1'  => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-2'  => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-3'  => 'http://codestarframework.com/assets/images/placeholder/80x80-e74c3c.gif',
        'opt-4'  => 'http://codestarframework.com/assets/images/placeholder/80x80-ffbc00.gif',
        'opt-5'  => 'http://codestarframework.com/assets/images/placeholder/80x80-3498db.gif',
        'opt-6'  => 'http://codestarframework.com/assets/images/placeholder/80x80-2ecc71.gif',
        'opt-7'  => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
        'opt-8'  => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50.gif',
      ),
      'default'  => array( 'opt-3', 'opt-4', 'opt-5', 'opt-6' )
    ),

    array(
      'id'      => 'opt-image-select-5',
      'type'    => 'image_select',
      'title'   => 'انتخاب عکس در استایل عمودی',
      'inline'  => true,
      'options' => array(
        'opt-1' => 'http://codestarframework.com/assets/images/placeholder/80x80-e74c3c.gif',
        'opt-2' => 'http://codestarframework.com/assets/images/placeholder/80x80-ffbc00.gif',
        'opt-3' => 'http://codestarframework.com/assets/images/placeholder/80x80-3498db.gif',
        'opt-4' => 'http://codestarframework.com/assets/images/placeholder/80x80-2ecc71.gif',
      ),
      'default' => 'opt-1'
    ),

  )
) );

//
// Field: button_set
//
CSF::createSection( $prefix, array(
  'parent'      => 'additional_fields',
  'title'       => 'دکمه ها',
  'icon'        => 'fas fa-ellipsis-h',
  'description' => 'اطلاعات بیشتر در مورد دکمه ها : <a href="http://codestarframework.com/documentation/#/fields?id=button-set" target="_blank">دکمه ها</a>',
  'fields'      => array(

    array(
      'id'         => 'opt-button-set-1',
      'type'       => 'button_set',
      'title'      => 'دکمه',
      'options'    => array(
        'enabled'  => 'فعال',
        'disabled' => 'غیرفعال',
      ),
    ),

    array(
      'id'         => 'opt-button-set-2',
      'type'       => 'button_set',
      'title'      => 'دکمه با مقدار پیشفرض',
      'options'    => array(
        'enabled'  => 'فعال',
        ''         => 'پیشفرض',
        'disabled' => 'غیرفعال',
      ),
    ),

    array(
      'id'           => 'opt-button-set-3',
      'type'         => 'button_set',
      'title'        => 'دکمه',
      'options'      => array(
        'activate'   => 'فعال سازی',
        'deactivate' => 'غیرفعال سازی',
      ),
      'default'      => 'فعال سازی',
    ),

    array(
      'id'      => 'opt-button-set-4',
      'type'    => 'button_set',
      'title'   => 'دکمه',
      'options' => array(
        'on'    => 'روشن',
        'off'   => 'خاموش',
      ),
      'default' => 'روشن',
    ),

    array(
      'id'       => 'opt-button-set-5',
      'type'     => 'button_set',
      'title'    => 'دکمه با امکان انتخاب چندگانه',
      'multiple' => true,
      'options'  => array(
        'opt-1'  => 'گزنه یک',
        'opt-2'  => 'گزینه دو',
        'opt-3'  => 'گزینه سه',
        'opt-4'  => 'گزینه چهار',
        'opt-5'  => 'گزینه پنج',
      ),
    ),

    array(
      'id'       => 'opt-button-set-6',
      'type'     => 'button_set',
      'title'    => 'دکمه با امکان انتخاب چندگانه و پیشفرض',
      'multiple' => true,
      'options'  => array(
          'opt-1'  => 'گزنه یک',
          'opt-2'  => 'گزینه دو',
          'opt-3'  => 'گزینه سه',
          'opt-4'  => 'گزینه چهار',
          'opt-5'  => 'گزینه پنج',
      ),
      'default'  => array( 'opt-2', 'opt-4' )
    ),

    array(
      'id'      => 'opt-button-set-7',
      'type'    => 'button_set',
      'title'   => 'دکه برای انتخاب دسته بندی ها',
      'options' => 'categories',
    ),

    array(
      'id'      => 'opt-button-set-8',
      'type'    => 'button_set',
      'title'   => 'دکمه برای برچسب ها',
      'options' => 'tags',
    ),

  )
) );

//
// Dependencies
//
CSF::createSection( $prefix, array(
  'title'       => 'وابستگی ها',
  'icon'        => 'fas fa-code-branch',
  'description' => 'اطلاعات بیشتر برای وابستگی ها: <a href="http://codestarframework.com/documentation/#/faq?id=how-to-use-dependency" target="_blank">نحوه استفاده از وابستگی ها</a>',
  'fields'      => array(

    array(
      'type'    => 'subheading',
      'content' => 'وابستگی های ابتدایی',
    ),

    //
    // Dependency example 1
    array(
      'id'         => 'opt-depend-switcher',
      'type'       => 'switcher',
      'title'      => 'وابسته به روشن بود سوئیچ',
    ),

    array(
      'type'       => 'notice',
      'style'      => 'success',
      'content'    => 'Success: سوئیچ روشن شد.',
      'dependency' => array( 'opt-depend-switcher', '==', 'true' ),
    ),

    //
    // Dependency example 2
    array(
      'id'         => 'opt-depend-text',
      'type'       => 'text',
      'title'      => 'اگر در فیلد چیزی تایپ شود',
    ),

    array(
      'type'        => 'notice',
      'style'       => 'success',
      'content'     => 'Success: شما چیزی تایپ کردین.',
      'dependency'  => array( 'opt-depend-text', '!=', '' ),
    ),

    //
    // Dependency example 3
    array(
      'id'          => 'opt-depend-select',
      'type'        => 'select',
      'title'       => 'رنگ آبی یا مشکی را انتخاب کنید',
      'placeholder' => 'یک رنگ انتخاب کنید',
      'options'     => array(
        'blue'      => 'آبی',
        'yellow'    => 'زرد',
        'green'     => 'سبز',
        'black'     => 'مشکی',
        'white'     => 'سفید',
      ),
    ),

    array(
      'type'       => 'notice',
      'style'      => 'success',
      'content'    => 'Success: آبی یا مشکلی انتخاب شد',
      'dependency' => array( 'opt-depend-select', 'any', 'blue,black' ),
    ),

    //
    // Dependency example 4
    array(
      'id'      => 'opt-depend-radio',
      'type'    => 'radio',
      'title'   => 'لطفا"بله لطفا" را انتخاب کنید',
      'inline'  => true,
      'options' => array(
        'no'    => 'نه ممنون',
        'yes'   => 'بله لطفا',
        'any'   => 'اطمینان ندارم!',
      ),
      'default' => 'no'
    ),

    array(
      'type'       => 'notice',
      'style'      => 'success',
      'content'    => 'Success: شما بله لطفا را انتخاب کرده اید',
      'dependency' => array( 'opt-depend-radio', '==', 'yes' ),
    ),

    //
    // Dependency example 5
    array(
      'id'       => 'opt-depend-checkbox',
      'type'     => 'checkbox',
      'title'    => 'سبز یا مشکی را انتخاب کنید',
      'inline'   => true,
      'options'  => array(
        'blue'   => 'آبی',
        'yellow' => 'زرد',
        'green'  => 'سبز',
        'black'  => 'مشکی',
        'white'  => 'سفید',
      ),
    ),

    array(
      'type'       => 'notice',
      'style'      => 'success',
      'content'    => 'Success: سبز انتخاب شد.',
      'dependency' => array( 'opt-depend-checkbox', 'any', 'green,black' ),
    ),

    //
    // Dependency example 6
    array(
      'id'       => 'opt-depend-image-select',
      'type'     => 'image_select',
      'title'    => 'باکس آبی را انتخاب کنید',
      'options'  => array(
        'green'  => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
        'red'    => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
        'yellow' => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
        'blue'   => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
        'gray'   => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
      ),
      'default'  => 'green',
    ),

    array(
      'type'       => 'notice',
      'style'      => 'success',
      'content'    => 'Success: رنگ آبی انتخاب شد.',
      'dependency' => array( 'opt-depend-image-select', '==', 'blue' ),
    ),

    //
    // Dependency example 6
    array(
      'id'       => 'opt-depend-image-select-any',
      'type'     => 'image_select',
      'title'    => 'اگر باکس قرمز یا آبی انتخاب شود',
      'options'  => array(
        'green'  => 'http://codestarframework.com/assets/images/placeholder/100x80-2ecc71.gif',
        'red'    => 'http://codestarframework.com/assets/images/placeholder/100x80-e74c3c.gif',
        'yellow' => 'http://codestarframework.com/assets/images/placeholder/100x80-ffbc00.gif',
        'blue'   => 'http://codestarframework.com/assets/images/placeholder/100x80-3498db.gif',
        'gray'   => 'http://codestarframework.com/assets/images/placeholder/100x80-555555.gif',
      ),
      'default'  => 'green',
    ),

    array(
      'type'       => 'notice',
      'style'      => 'success',
      'content'    => 'Success: باکس قرمز یا آبی انتخاب شد',
      'dependency' => array( 'opt-depend-image-select-any', 'any', 'red,blue' ),
    ),

    array(
      'type'    => 'subheading',
      'content' => 'وابستگی های قابل مشاهده',
    ),

    //
    // Dependency example 7
    array(
      'id'          => 'opt-depend-visible-switcher',
      'type'        => 'switcher',
      'title'       => 'روشن کنید',
      'label'       => 'اگر به روشن تغییر دهید فیلد های زیر فعال می شوند',
    ),

    array(
      'id'          => 'opt-depend-visible-text',
      'type'        => 'text',
      'title'       => 'متن فعال',
      'dependency'  => array( 'opt-depend-visible-switcher', '==', 'true', '', 'visible' ),
    ),

    array(
      'id'          => 'opt-depend-visible-select',
      'type'        => 'select',
      'title'       => 'انتخابگر فعال',
      'placeholder' => 'یک گزینه را انتخاب کنید',
      'options'     => array(
        'opt-1'     => 'گزینه یک',
        'opt-2'     => 'گزینه دو',
        'opt-3'     => 'گزینه سه',
      ),
      'dependency'  => array( 'opt-depend-visible-switcher', '==', 'true', '', 'visible' ),
    ),

    //
    // Dependency example 8
    array(
      'type'    => 'subheading',
      'content' => 'وابستگی های تو در تو',
    ),

    array(
      'id'    => 'opt-depend-switcher-1',
      'type'  => 'switcher',
      'title' => 'اگر به روشن تغییر یافت --->',
    ),

    array(
      'id'          => 'opt-depend-select-1',
      'type'        => 'select',
      'title'       => '---> و به آبی انخاب شد',
      'placeholder' => 'یک رنگ انتخاب کنید',
      'options'     => array(
        'blue'      => 'آبی',
        'yellow'    => 'زرد',
        'green'     => 'سبز',
        'black'     => 'مشکی',
        'white'     => 'سفید',
      ),
    ),

    array(
      'type'       => 'notice',
      'style'      => 'success',
      'content'    => 'Success: روشن شد و رنگ آبی انتخاب شد',
      'dependency' => array( 'opt-depend-switcher-1|opt-depend-select-1', '==|==', 'true|blue' ),
    ),

    //
    // Dependency example 9
    array(
      'type'    => 'subheading',
      'content' => 'یکی دیگر از وابستگی های تو در تو',
    ),

    array(
      'id'          => 'opt-nested-select-1',
      'type'        => 'select',
      'title'       => 'اگر سفید یا مشکی انتخاب شد --->',
      'placeholder' => 'یک رنگ انتخاب کنید',
      'options'     => array(
        'blue'      => 'آبی',
        'yellow'    => 'زرد',
        'green'     => 'سبز',
        'black'     => 'مشکی',
        'white'     => 'سفید',
      ),
    ),

    array(
      'id'          => 'opt-nested-select-2',
      'type'        => 'select',
      'title'       => '---> و (Large) انتخاب شد --->',
      'placeholder' => 'یک سایز انتخاب کنید',
      'options'     => array(
        'small'     => 'Small',
        'middle'    => 'Middle',
        'large'     => 'Large',
        'xlage'     => 'XLarge',
        'xxlage'    => 'XXLarge',
      ),
      'dependency'  => array( 'opt-nested-select-1', 'any', 'black,white' ),
    ),

    array(
      'id'          => 'opt-nested-select-3',
      'type'        => 'select',
      'title'       => '---> و سلام انتخاب شد',
      'placeholder' => 'یک کلمه انتخاب کنید',
      'options'     => array(
        'hello'     => 'سلام',
        'world'     => 'دنیا',
      ),
      'dependency'  => array( 'opt-nested-select-1|opt-nested-select-2', 'any|==', 'black,white|large' ),
    ),

    array(
      'type'       => 'notice',
      'style'      => 'success',
      'content'    => 'Congratulations, شما اینجا هستید!',
      'dependency' => array( 'opt-nested-select-1|opt-nested-select-2|opt-nested-select-3', 'any|==|==', 'black,white|large|hello' ),
    ),

  )
) );

//
// Validate
//
CSF::createSection( $prefix, array(
  'title'       => 'تایید اعتبار',
  'icon'        => 'fas fa-check-circle',
  'description' => 'اطلاعات بیشتر در مورد تایید اعتبار: <a href="http://codestarframework.com/documentation/#/faq?id=how-to-use-validate" target="_blank">How to use validate</a>',
  'fields'      => array(

    array(
      'id'       => 'opt-validate-1',
      'type'     => 'text',
      'title'    => 'تایید اعتبار ایمیل',
      'subtitle' => 'این فیلد فقط آدرس ایمیل را می پذیرد.',
      'default'  => 'info@domain.com',
      'validate' => 'csf_validate_email',
    ),

    array(
      'id'       => 'opt-validate-2',
      'type'     => 'text',
      'title'    => 'تایید اعتبار عددی',
      'subtitle' => 'این فیلد فقط عدد را می پذیرد',
      'default'  => '123456',
      'validate' => 'csf_validate_numeric',
    ),

    array(
      'id'       => 'opt-validate-3',
      'type'     => 'text',
      'title'    => 'الزامی',
      'subtitle' => 'این فیلد نمی تواند خالی باشد.',
      'default'  => 'لورم ایپسوم متن',
      'validate' => 'csf_validate_required',
    ),

    array(
      'id'       => 'opt-validate-4',
      'type'     => 'text',
      'title'    => 'تایید اعتبار url',
      'subtitle' => 'این فیلد فقط url را می پذیرد.',
      'default'  => 'http://codestarframework.com',
      'validate' => 'csf_validate_url',
    ),

  )
) );

//
// Sanitize
//
CSF::createSection( $prefix, array(
  'title'       => 'جایگذاری',
  'icon'        => 'fas fa-redo',
  'description' => 'اطلاعات بیشتر در مورد جایگذاری: <a href="http://codestarframework.com/documentation/#/faq?id=how-to-use-sanitize" target="_blank">چطور جایگذین کنیم</a>',
  'fields'      => array(

    array(
      'id'       => 'opt-sanitize-1',
      'type'     => 'text',
      'title'    => 'جایگذاری a به b',
      'subtitle' => 'بطور مثال کلمه apple به bpple تغییر پیدا می کند ',
      'sanitize' => 'csf_sanitize_replace_a_to_b'
    ),

    array(
      'id'       => 'opt-sanitize-2',
      'type'     => 'text',
      'title'    => 'جایگذین کردن عنوان',
      'subtitle' => ' جایگذینی (فاصله) با (-) و حروف بزرگ به حروف کوچک',
      'sanitize' => 'csf_sanitize_title'
    ),

  )
) );

//
// Field: backup
//
CSF::createSection( $prefix, array(
  'title'       => 'پشتیبان گیری',
  'icon'        => 'fas fa-shield-alt',
  'description' => 'اطلاعات بیشتر در مورد پشتیبان گیری : <a href="http://codestarframework.com/documentation/#/fields?id=backup" target="_blank">پشتیبان گیری p</a>',
  'fields'      => array(

    array(
      'type' => 'backup',
    ),

  )
) );

//
// Others
//
CSF::createSection( $prefix, array(
  'title'       => 'دیگر',
  'icon'        => 'fas fa-bolt',
  'description' => 'اطلاعات بیشتر در مورد دیگر : <a href="http://codestarframework.com/documentation/#/fields?id=others" target="_blank">دیگر</a>',
  'fields'      => array(

    array(
      'type'    => 'heading',
      'content' => 'این یک فیلد عنوان است',
    ),

    array(
      'type'    => 'subheading',
      'content' => 'این یک زیرعنوان است',
    ),

    array(
      'type'    => 'content',
      'content' => 'این یک فیلد متن است',
    ),

    array(
      'type'    => 'submessage',
      'style'   => 'success',
        'content' => 'این یک متن  <strong>پیغام </strong> است . و استایل آن  <strong>موفقیت</strong> است',
    ),

    array(
      'type'    => 'content',
      'content' => 'This is a content field',
    ),

    array(
      'type'    => 'submessage',
      'style'   => 'info',
        'content' => 'این یک متن  <strong>پیغام </strong> است . و استایل آن  <strong>اطلاعات</strong> است',
    ),

    array(
      'type'    => 'submessage',
      'style'   => 'warning',
        'content' => 'این یک متن  <strong>پیغام </strong> است . و استایل آن  <strong>اخطار</strong> است',
    ),

    array(
      'type'    => 'submessage',
      'style'   => 'danger',
        'content' => 'این یک متن  <strong>پیغام </strong> است . و استایل آن  <strong>خطر</strong> است',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'success',
        'content' => 'این یک  <strong>اطلاع</strong> است . و استایل آن <strong>موفقیت</strong> است',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'info',
        'content' => 'این یک  <strong>اطلاع</strong> است . و استایل آن <strong>پیغام</strong> است',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'warning',
        'content' => 'این یک  <strong>اطلاع</strong> است . و استایل آن <strong>اخطار</strong> است',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'danger',
        'content' => 'این یک  <strong>اطلاع</strong> است . و استایل آن <strong>خطر</strong> است',
    ),

    array(
      'type'    => 'content',
        'content' => 'این یک  <strong>متن</strong> است . شما می توانید متنی را اینجا بنویسید.',
    ),

  )
) );
