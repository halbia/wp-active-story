<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

//
// Metabox of the PAGE
// Set a unique slug-like ID
//
$prefix_page_opts = '_prefix_page_options';

//
// Create a metabox
//
CSF::createMetabox( $prefix_page_opts, array(
  'title'        => 'تنظیمات اختصاصی برگه ها',
  'post_type'    => 'page',
  'show_restore' => true,
) );

//
// Create a section
//
CSF::createSection( $prefix_page_opts, array(
  'title'  => 'نمایشی',
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

  )
) );

//
// Create a section
//
CSF::createSection( $prefix_page_opts, array(
  'title'  => 'فیلد های بیشتر',
  'icon'   => 'fas fa-tint',
  'fields' => array(

    array(
      'id'      => 'opt-image-select',
      'type'    => 'image_select',
      'title'   => 'Image Select',
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
      'title' => 'Background',
    ),

    array(
      'type'    => 'notice',
      'style'   => 'success',
      'content' => 'A <strong>notice</strong> field with <strong>success</strong> style.',
    ),

    array(
      'id'    => 'opt-icon',
      'type'  => 'icon',
      'title' => 'Icon',
    ),

    array(
      'id'    => 'opt-alt-text',
      'type'  => 'text',
      'title' => 'Text',
    ),

    array(
      'id'         => 'opt-alt-textarea',
      'type'       => 'textarea',
      'title'      => 'Textarea',
      'subtitle'   => 'A textarea with shortcoder.',
      'shortcoder' => 'csf_demo_shortcodes',
    ),

  )
) );

//
// Metabox of the POST
// Set a unique slug-like ID
//
$prefix_post_opts = '_prefix_post_options';

//
// Create a metabox
//
CSF::createMetabox( $prefix_post_opts, array(
  'title'        => 'تنظیمات اختصاصی نوشته ها',
  'post_type'    => 'post',
  'show_restore' => true,
) );

//
// Create a section
//
CSF::createSection( $prefix_post_opts, array(
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


  )
) );

//
// Metabox of the PAGE and POST both.
// Set a unique slug-like ID
//
$prefix_meta_opts = '_prefix_meta_options';

//
// Create a metabox
//
CSF::createMetabox( $prefix_meta_opts, array(
  'title'     => 'تنظیمات اختصاصی',
  'post_type' => array( 'post', 'page' ),
  'context'   => 'side',
) );

//
// Create a section
//
CSF::createSection( $prefix_meta_opts, array(
  'fields' => array(

    //
    // A text field
    //
    array(
      'id'    => 'opt-text',
      'type'  => 'text',
      'title' => 'متن چندخطی',
    ),

    array(
      'id'    => 'opt-switcher',
      'type'  => 'switcher',
      'title' => 'دکمه سوئیچ',
      'label' => 'متن توضیح کوتاه .',
    ),

    array(
      'id'    => 'opt-color',
      'type'  => 'color',
      'title' => 'رنگ',
    ),

    array(
      'id'          => 'opt-select',
      'type'        => 'select',
      'title'       => 'Select',
      'placeholder' => 'Select an option',
      'options'     => array(
        'opt-1'     => 'Option 1',
        'opt-2'     => 'Option 2',
        'opt-3'     => 'Option 3',
      ),
    ),

  )
) );
