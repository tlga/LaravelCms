<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
  <!-- BEGIN: Aside Menu -->
  <div
    id="m_ver_menu"
    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
    data-menu-vertical="true"
    data-menu-scrollable="false" data-menu-dropdown-timeout="500"
  >
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
      <li class="m-menu__item  m-menu__item--active" aria-haspopup="true" >
        <a  href="{{ route('admin.administrator') }}" class="m-menu__link ">
          <i class="m-menu__link-icon flaticon-line-graph"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Başlangıç
											</span>
											<!--<span class="m-menu__link-badge">
												<span class="m-badge m-badge--danger">
													2
												</span>
											</span>-->
										</span>
									</span>
        </a>
      </li>
      <li class="m-menu__section">
        <h4 class="m-menu__section-text">
          Ön Yüz İşlemleri
        </h4>
        <i class="m-menu__section-icon flaticon-more-v3"></i>
      </li>
      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="#" class="m-menu__link m-menu__toggle">
          <i class="m-menu__link-icon flaticon-layers"></i>
									<span class="m-menu__link-text">
										Yazılar
									</span>
          <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu">
          <span class="m-menu__arrow"></span>
          <ul class="m-menu__subnav">
            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
              <a  href="#" class="m-menu__link ">
												<span class="m-menu__link-text">
													Yazılar
												</span>
              </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="{{ route('admin.allArticle') }}" class="m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                  <span></span>
                </i>
												<span class="m-menu__link-text">
													Tüm Yazılar
												</span>
              </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="{{ URL::Route('admin.articleProcess') }}" class="m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                  <span></span>
                </i>
												<span class="m-menu__link-text">
													Yeni Ekle
												</span>
              </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="{{ URL::Route('admin.categories') }}" class="m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                  <span></span>
                </i>
												<span class="m-menu__link-text">
													Kategoriler
												</span>
              </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="{{ URL::Route('admin.tags') }}" class="m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                  <span></span>
                </i>
												<span class="m-menu__link-text">
													Etiketler
												</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="{{ route('admin.imageLibrary') }}" class="m-menu__link m-menu__toggle">
          <i class="m-menu__link-icon flaticon-share"></i>
									<span class="m-menu__link-text">
										Ortam Kütüphanesi
									</span>
        </a>
      </li>
      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="#" class="m-menu__link m-menu__toggle">
          <i class="m-menu__link-icon flaticon-file"></i>
									<span class="m-menu__link-text">
										Sayfalar
									</span>
          <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu">
          <span class="m-menu__arrow"></span>
          <ul class="m-menu__subnav">
            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
              <a  href="#" class="m-menu__link ">
												<span class="m-menu__link-text">
													Sayfalar
												</span>
              </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="{{ route('admin.allPage') }}" class="m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                  <span></span>
                </i>
												<span class="m-menu__link-text">
													Tüm Sayfalar
												</span>
              </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="{{ route('admin.pageProcess') }}" class="m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                  <span></span>
                </i>
												<span class="m-menu__link-text">
													Yeni Ekle
												</span>
              </a>
            </li>
           </ul>
        </div>
      </li>
      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="#" class="m-menu__link">
          <i class="m-menu__link-icon flaticon-chat-1"></i>
									<span class="m-menu__link-text">
										Yorumlar
									</span>
        </a>
      </li>

      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="{{ route('admin.slider') }}" class="m-menu__link">
          <i class="m-menu__link-icon flaticon-more-v4"></i>
									<span class="m-menu__link-text">
										Slider
									</span>
        </a>
      </li>
      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="#" class="m-menu__link m-menu__toggle">
          <i class="m-menu__link-icon flaticon-users"></i>
									<span class="m-menu__link-text">
										Kullanıcılar
									</span>
          <i class="m-menu__ver-arrow la la-angle-right"></i>
        </a>
        <div class="m-menu__submenu">
          <span class="m-menu__arrow"></span>
          <ul class="m-menu__subnav">
            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
              <a  href="#" class="m-menu__link ">
												<span class="m-menu__link-text">
													Kullanıcılar
												</span>
              </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="{{ route('admin.userProcess') }}" class="m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                  <span></span>
                </i>
                    <span class="m-menu__link-text">
                      Tüm Kullanıcılar
                    </span>
              </a>
            </li>
            <li class="m-menu__item " aria-haspopup="true" >
              <a  href="{{ route('admin.register') }}" class="m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                  <span></span>
                </i>
                    <span class="m-menu__link-text">
                      Yönetici Oluştur
                    </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="m-menu__section">
        <h4 class="m-menu__section-text">
          Yapılandırma
        </h4>
        <i class="m-menu__section-icon flaticon-more-v3"></i>
      </li>
      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="#" class="m-menu__link">
          <i class="m-menu__link-icon flaticon-cogwheel-2"></i>
									<span class="m-menu__link-text">
										Ayarlar
									</span>
        </a>
      </li>
      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="#" class="m-menu__link">
          <i class="m-menu__link-icon flaticon-map"></i>
									<span class="m-menu__link-text">
										Sistem
									</span>
        </a>
      </li>
      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
        <a  href="https://www.auramedya.com/#iletisim" class="m-menu__link">
          <i class="m-menu__link-icon flaticon-lifebuoy"></i>
									<span class="m-menu__link-text">
										Destek
									</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->