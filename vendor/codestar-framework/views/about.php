<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly. ?>

<div class="csf-welcome-cols">

  <div class="csf--col csf--col-first">
    <span class="csf--icon csf--active"><i class="fas fa-check"></i></span>
    <div class="csf--title">تنظیمات پنل ادمین</div>
    <p class="csf--text">شما می توانید به راحتی با کمک این افزونه برای قالب و یا افزونه های خود پنل تنظیمات حرفه ای پیاده سازی کنید</p>
  </div>

  <div class="csf--col csf--col-first">
    <span class="csf--icon csf--<?php echo esc_attr( CSF::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( CSF::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="csf--title">تنظیمات سفارشی سازی</div>
    <p class="csf--text">در بخش تنظیمات سفارشی سازی با ادغام فیلدها و گزینه های شخصی خودتان با بخش سفارشی سازی پیش فرض وردپرس بصورت زنده سایت خود را شخصی سازی کنید.</p>
  </div>

  <div class="csf--col csf--col-first csf--last">
    <span class="csf--icon csf--<?php echo esc_attr( CSF::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( CSF::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="csf--title">تنظیمات متاباکس ها</div>
    <p class="csf--text">در بخش تنظیمات متاباکس ها شما می توانید به راحتی به هرنوع پست یا پست تایپی متاباکس اضافه کنید و آن را در صفحات وب سایت خود به نمایش بگذارید</p>
  </div>

  <div class="clear"></div>

  <div class="csf--col csf--col-first">
    <span class="csf--icon csf--<?php echo esc_attr( CSF::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( CSF::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="csf--title">تنظیمات منو ها</div>
    <p class="csf--text">در بخش تنظیمات فهرست ها شما قادر به ایجاد تنظیمات شخصی برای فهرست های خود را خواهید داشت، ما تنظیمات پیشرفته با تعداد زیادی فیلد را ارائه می دهیم.</p>
  </div>

  <div class="csf--col csf--col-first">
    <span class="csf--icon csf--<?php echo esc_attr( CSF::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( CSF::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="csf--title">تنظیمات تاگزونومی ها</div>
    <p class="csf--text">بخش تنظیمات تاکسونومی با تعداد زیادی فیلد به شما امکان می دهد تنظیمات شخصی خود را برای همه دسته ها ، برچسب ها یا CPT های اختصاصی خود ایجاد نمایید.</p>
  </div>

  <div class="csf--col csf--col-first csf--last">
    <span class="csf--icon csf--<?php echo esc_attr( CSF::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( CSF::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="csf--title">تنظیمات پروفایل</div>
    <p class="csf--text">بخش تنظیمات پروفایل کاربری با تعداد زیادی فیلد به شما امکان می دهد تنظیمات و یا اطلاعات شخصی را برای همه کاربران ایجاد و یا سفارشی سازی کنید.</p>
  </div>

  <div class="clear"></div>

  <div class="csf--col">
    <span class="csf--icon csf--<?php echo esc_attr( CSF::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( CSF::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="csf--title">تنظیمات ابزارک ها</div>
    <p class="csf--text">بخش تنظیمات ابزارک ها با تعداد زیادی از فیلدها به شما امکان می دهد، ابزارک های سفارشی با تنظیمات پیشرفته را آسانتر ایجاد کنید.</p>
  </div>

  <div class="csf--col">
    <span class="csf--icon csf--<?php echo esc_attr( CSF::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( CSF::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="csf--title">تنظیمات دیدگاه ها</div>
    <p class="csf--text">در بخش تنظیمات دیدگاه ها می توانید با تعداد زیادی از زمینه ها متاباکس های سفارشی را برای نظرات کاربران و یا پست های خود ایجاد کنید.</p>
  </div>

  <div class="csf--col csf--last">
    <span class="csf--icon csf--<?php echo esc_attr( CSF::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( CSF::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="csf--title">تنظیمات شورتکد ها</div>
    <p class="csf--text">بخش تنظیمات شورتکد روشی است برای مدیریت و یا ساخت آسانتر و منعطف تر محتوای شما با استفاده از کد کوتاه از پیش ساخته شده می باشد.</p>
  </div>

  <?php if ( ! CSF::$premium ) { ?>
  <div class="clear"></div>
  <div class="csf--col-upgrade">
    <a href="http://codestarframework.com/" class="button button-primary" target="_blank" rel="nofollow"><i class="fas fa-share"></i> Upgrade Premium Version</a>
  </div>
  <?php } ?>

  <div class="clear"></div>
</div>

<hr />

<div class="csf-features-cols csf--col-wrap">
  <div class="csf--col csf--key-features">

  <h4>Key Features</h4>

  <ul>
    <li>WordPress 6.2.x Ready</li>
    <li>Gutenberg Ready</li>
    <li>Multiple instances</li>
    <li>Unlimited frameworks</li>
    <li>Output css styles</li>
    <li>Output typography</li>
    <li>Advanced option fields</li>
    <li>Fields dependencies based on rules</li>
    <li>Sanitize and validate fields</li>
    <li>Ajax saving</li>
    <li>Localization</li>
    <li>Useful hooks for configurations</li>
    <li>Export and import options</li>
    <li>and much more...</li>
  </ul>

  </div>

  <div class="csf--col csf--available-fields">

  <h4>Available Fields</h4>

  <table class="csf--table-fields fixed widefat">
    <tbody>
      <tr>
        <td>text</td>
        <td>accordion</td>
        <td>background</td>
        <td>backup</td>
        <td>icon</td>
      </tr>
      <tr>
        <td>textarea</td>
        <td>repeater</td>
        <td>heading</td>
        <td>date</td>
        <td>code_editor</td>
      </tr>
      <tr>
        <td>checkbox</td>
        <td>group</td>
        <td>image_select</td>
        <td>slider</td>
        <td>content</td>
      </tr>
      <tr>
        <td>select</td>
        <td>gallery</td>
        <td>notice</td>
        <td>fieldset</td>
        <td>typography</td>
      </tr>
      <tr>
        <td>switcher</td>
        <td>sorter</td>
        <td>link_color</td>
        <td>subheading</td>
        <td>upload</td>
      </tr>
      <tr>
        <td>color</td>
        <td>media</td>
        <td>radio</td>
        <td>tabbed</td>
        <td>wp_editor</td>
      </tr>
      <tr>
        <td>spacing</td>
        <td>border</td>
        <td>palette</td>
        <td>spinner</td>
        <td>dimensions</td>
      </tr>
      <tr>
        <td>link_color</td>
        <td>sortable</td>
        <td>button_set</td>
        <td>accordion</td>
        <td>others</td>
      </tr>
    </tbody>
  </table>

  <p>and more on the way...</p>

  </div>

  <div class="clear"></div>
</div>

<?php if ( CSF::$premium ) { ?>
<hr />
<h5>You can force to disable this page with (it would works for only premium users):</h5>
<div class="csf-code-block">
<pre>
add_filter( 'csf_welcome_page', '__return_false' );
</pre>
</div>
<?php } ?>
