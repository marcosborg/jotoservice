<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw fas fa-users">

                    </i>
                    <span>{{ trans('cruds.userManagement.title') }}</span>
                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active"
                        : "" }}">
                        <a href="{{ route("admin.permissions.index") }}">
                            <i class="fa-fw fas fa-unlock-alt">

                            </i>
                            <span>{{ trans('cruds.permission.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                        <a href="{{ route("admin.roles.index") }}">
                            <i class="fa-fw fas fa-briefcase">

                            </i>
                            <span>{{ trans('cruds.role.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('user_access')
                    <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                        <a href="{{ route("admin.users.index") }}">
                            <i class="fa-fw fas fa-user">

                            </i>
                            <span>{{ trans('cruds.user.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('company_access')
                    <li class="{{ request()->is("admin/companies") || request()->is("admin/companies/*") ? "active" :
                        "" }}">
                        <a href="{{ route("admin.companies.index") }}">
                            <i class="fa-fw fas fa-building">

                            </i>
                            <span>{{ trans('cruds.company.title') }}</span>

                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('tvde_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw fas fa-globe">

                    </i>
                    <span>{{ trans('cruds.tvde.title') }}</span>
                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('driver_access')
                    <li class="{{ request()->is("admin/drivers") || request()->is("admin/drivers/*") ? "active" : ""
                        }}">
                        <a href="{{ route("admin.drivers.index") }}">
                            <i class="fa-fw fas fa-address-card">

                            </i>
                            <span>{{ trans('cruds.driver.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('tvde_config_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-cogs">

                            </i>
                            <span>{{ trans('cruds.tvdeConfig.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('card_access')
                            <li class="{{ request()->is("admin/cards") || request()->is("admin/cards/*") ? "active" :
                                "" }}">
                                <a href="{{ route("admin.cards.index") }}">
                                    <i class="fa-fw fas fa-credit-card">

                                    </i>
                                    <span>{{ trans('cruds.card.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('electric_access')
                            <li class="{{ request()->is("admin/electrics") || request()->is("admin/electrics/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.electrics.index") }}">
                                    <i class="fa-fw fas fa-bolt">

                                    </i>
                                    <span>{{ trans('cruds.electric.title') }}</span>
                                </a>
                            </li>
                            @endcan
                            @can('local_access')
                            <li class="{{ request()->is("admin/locals") || request()->is("admin/locals/*") ? "active" :
                                "" }}">
                                <a href="{{ route("admin.locals.index") }}">
                                    <i class="fa-fw fas fa-map-marked">

                                    </i>
                                    <span>{{ trans('cruds.local.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('state_access')
                            <li class="{{ request()->is("admin/states") || request()->is("admin/states/*") ? "active" :
                                "" }}">
                                <a href="{{ route("admin.states.index") }}">
                                    <i class="fa-fw fas fa-plug">

                                    </i>
                                    <span>{{ trans('cruds.state.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('tvde_operator_access')
                            <li class="{{ request()->is("admin/tvde-operators") || request()->
                                is("admin/tvde-operators/*") ? "active" : "" }}">
                                <a href="{{ route("admin.tvde-operators.index") }}">
                                    <i class="fa-fw fas fa-car">

                                    </i>
                                    <span>{{ trans('cruds.tvdeOperator.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('contract_type_access')
                            <li class="{{ request()->is("admin/contract-types") || request()->
                                is("admin/contract-types/*") ? "active" : "" }}">
                                <a href="{{ route("admin.contract-types.index") }}">
                                    <i class="fa-fw fas fa-file-signature">

                                    </i>
                                    <span>{{ trans('cruds.contractType.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('contract_type_rank_access')
                            <li class="{{ request()->is("admin/contract-type-ranks") || request()->
                                is("admin/contract-type-ranks/*") ? "active" : "" }}">
                                <a href="{{ route("admin.contract-type-ranks.index") }}">
                                    <i class="fa-fw fas fa-file-signature">

                                    </i>
                                    <span>{{ trans('cruds.contractTypeRank.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('contract_vat_access')
                            <li class="{{ request()->is("admin/contract-vats") || request()->
                                is("admin/contract-vats/*") ? "active" : "" }}">
                                <a href="{{ route("admin.contract-vats.index") }}">
                                    <i class="fa-fw fas fa-file-signature">

                                    </i>
                                    <span>{{ trans('cruds.contractVat.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('activity_management_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-cogs">

                            </i>
                            <span>{{ trans('cruds.activityManagement.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('tvde_year_access')
                            <li class="{{ request()->is("admin/tvde-years") || request()->is("admin/tvde-years/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.tvde-years.index") }}">
                                    <i class="fa-fw far fa-calendar-alt">

                                    </i>
                                    <span>{{ trans('cruds.tvdeYear.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('tvde_month_access')
                            <li class="{{ request()->is("admin/tvde-months") || request()->is("admin/tvde-months/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.tvde-months.index") }}">
                                    <i class="fa-fw far fa-calendar-alt">

                                    </i>
                                    <span>{{ trans('cruds.tvdeMonth.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('tvde_week_access')
                            <li class="{{ request()->is("admin/tvde-weeks") || request()->is("admin/tvde-weeks/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.tvde-weeks.index") }}">
                                    <i class="fa-fw far fa-calendar-alt">

                                    </i>
                                    <span>{{ trans('cruds.tvdeWeek.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('document_access')
                    <li class="{{ request()->is("admin/documents") || request()->is("admin/documents/*") ? "active" :
                        "" }}">
                        <a href="{{ route("admin.documents.index") }}">
                            <i class="fa-fw far fa-file">

                            </i>
                            <span>{{ trans('cruds.document.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('receipt_access')
                    <li class="{{ request()->is("admin/receipts") || request()->is("admin/receipts/*") ? "active" : ""
                        }}">
                        <a href="{{ route("admin.receipts.index") }}">
                            <i class="fa-fw fas fa-file-invoice-dollar">

                            </i>
                            <span>{{ trans('cruds.receipt.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('tvde_activity_access')
                    <li class="{{ request()->is("admin/tvde-activities") || request()->is("admin/tvde-activities/*") ?
                        "active" : "" }}">
                        <a href="{{ route("admin.tvde-activities.index") }}">
                            <i class="fa-fw fas fa-table">

                            </i>
                            <span>{{ trans('cruds.tvdeActivity.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('combustion_transaction_access')
                    <li class="{{ request()->is("admin/combustion-transactions") || request()->
                        is("admin/combustion-transactions/*") ? "active" : "" }}">
                        <a href="{{ route("admin.combustion-transactions.index") }}">
                            <i class="fa-fw fas fa-gas-pump">

                            </i>
                            <span>{{ trans('cruds.combustionTransaction.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('electric_transaction_access')
                    <li class="{{ request()->is("admin/electric-transactions") || request()->
                        is("admin/electric-transactions/*") ? "active" : "" }}">
                        <a href="{{ route("admin.electric-transactions.index") }}">
                            <i class="fa-fw fas fa-bolt">

                            </i>
                            <span>{{ trans('cruds.electricTransaction.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('adjustment_access')
                    <li class="{{ request()->is("admin/adjustments") || request()->is("admin/adjustments/*") ? "active"
                        : "" }}">
                        <a href="{{ route("admin.adjustments.index") }}">
                            <i class="fa-fw fas fa-coins">

                            </i>
                            <span>{{ trans('cruds.adjustment.title') }}</span>

                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('my_document_access')
            <li class="{{ request()->is("admin/my-documents") || request()->is("admin/my-documents/*") ? "active" : ""
                }}">
                <a href="{{ route("admin.my-documents.index") }}">
                    <i class="fa-fw far fa-file">

                    </i>
                    <span>{{ trans('cruds.myDocument.title') }}</span>

                </a>
            </li>
            @endcan
            @can('my_receipt_access')
            <li class="{{ request()->is("admin/my-receipts") || request()->is("admin/my-receipts/*") ? "active" : ""
                }}">
                <a href="{{ route("admin.my-receipts.index") }}">
                    <i class="fa-fw fas fa-file-invoice-dollar">

                    </i>
                    <span>{{ trans('cruds.myReceipt.title') }}</span>

                </a>
            </li>
            @endcan
            @can('financial_statement_access')
            <li class="{{ request()->is("admin/financial-statements") || request()->is("admin/financial-statements/*")
                ? "active" : "" }}">
                <a href="{{ route("admin.financial-statements.index") }}">
                    <i class="fa-fw fas fa-file-invoice-dollar">

                    </i>
                    <span>{{ trans('cruds.financialStatement.title') }}</span>

                </a>
            </li>
            @endcan
            @can('user_alert_access')
            <li class="{{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : ""
                }}">
                <a href="{{ route("admin.user-alerts.index") }}">
                    <i class="fa-fw fas fa-bell">

                    </i>
                    <span>{{ trans('cruds.userAlert.title') }}</span>

                </a>
            </li>
            @endcan
            @can('newsletter_access')
            <li class="{{ request()->is("admin/newsletters") || request()->is("admin/newsletters/*") ? "active" : ""
                }}">
                <a href="{{ route("admin.newsletters.index") }}">
                    <i class="fa-fw far fa-newspaper">

                    </i>
                    <span>{{ trans('cruds.newsletter.title') }}</span>

                </a>
            </li>
            @endcan
            @can('company_document_access')
            <li class="{{ request()->is("admin/company-documents") || request()->is("admin/company-documents/*") ?
                "active" : "" }}">
                <a href="{{ route("admin.company-documents.index") }}">
                    <i class="fa-fw fas fa-building">

                    </i>
                    <span>{{ trans('cruds.companyDocument.title') }}</span>

                </a>
            </li>
            @endcan
            @can('website_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw fas fa-globe">

                    </i>
                    <span>{{ trans('cruds.website.title') }}</span>
                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('home_page_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-home">

                            </i>
                            <span>{{ trans('cruds.homePage.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('hero_banner_access')
                            <li class="{{ request()->is("admin/hero-banners") || request()->is("admin/hero-banners/*")
                                ? "active" : "" }}">
                                <a href="{{ route("admin.hero-banners.index") }}">
                                    <i class="fa-fw fas fa-image">

                                    </i>
                                    <span>{{ trans('cruds.heroBanner.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('home_info_access')
                            <li class="{{ request()->is("admin/home-infos") || request()->is("admin/home-infos/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.home-infos.index") }}">
                                    <i class="fa-fw fas fa-info">

                                    </i>
                                    <span>{{ trans('cruds.homeInfo.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('activity_access')
                            <li class="{{ request()->is("admin/activities") || request()->is("admin/activities/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.activities.index") }}">
                                    <i class="fa-fw fas fa-boxes">

                                    </i>
                                    <span>{{ trans('cruds.activity.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('testimonial_access')
                            <li class="{{ request()->is("admin/testimonials") || request()->is("admin/testimonials/*")
                                ? "active" : "" }}">
                                <a href="{{ route("admin.testimonials.index") }}">
                                    <i class="fa-fw fas fa-users">

                                    </i>
                                    <span>{{ trans('cruds.testimonial.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('faq_management_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-question">

                            </i>
                            <span>{{ trans('cruds.faqManagement.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('faq_category_access')
                            <li class="{{ request()->is("admin/faq-categories") || request()->
                                is("admin/faq-categories/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.faq-categories.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.faqCategory.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('faq_question_access')
                            <li class="{{ request()->is("admin/faq-questions") || request()->
                                is("admin/faq-questions/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.faq-questions.index") }}">
                                    <i class="fa-fw fas fa-question">

                                    </i>
                                    <span>{{ trans('cruds.faqQuestion.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('car_rental_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-car">

                            </i>
                            <span>{{ trans('cruds.carRental.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('car_access')
                            <li class="{{ request()->is("admin/cars") || request()->is("admin/cars/*") ? "active" : ""
                                }}">
                                <a href="{{ route("admin.cars.index") }}">
                                    <i class="fa-fw fas fa-car">

                                    </i>
                                    <span>{{ trans('cruds.car.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('car_rental_contact_request_access')
                            <li class="{{ request()->is("admin/car-rental-contact-requests") || request()->
                                is("admin/car-rental-contact-requests/*") ? "active" : "" }}">
                                <a href="{{ route("admin.car-rental-contact-requests.index") }}">
                                    <i class="fa-fw fas fa-envelope">

                                    </i>
                                    <span>{{ trans('cruds.carRentalContactRequest.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('page_menu_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-sitemap">

                            </i>
                            <span>{{ trans('cruds.pageMenu.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('page_access')
                            <li class="{{ request()->is("admin/pages") || request()->is("admin/pages/*") ? "active" :
                                "" }}">
                                <a href="{{ route("admin.pages.index") }}">
                                    <i class="fa-fw fas fa-sitemap">

                                    </i>
                                    <span>{{ trans('cruds.page.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('page_form_access')
                            <li class="{{ request()->is("admin/page-forms") || request()->is("admin/page-forms/*") ?
                                "active" :
                                "" }}">
                                <a href="{{ route("admin.page-forms.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>{{ trans('cruds.pageForm.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('menu_own_car_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-car">

                            </i>
                            <span>{{ trans('cruds.menuOwnCar.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('own_car_access')
                            <li class="{{ request()->is("admin/own-cars") || request()->is("admin/own-cars/*") ?
                                "active" : ""
                                }}">
                                <a href="{{ route("admin.own-cars.index") }}">
                                    <i class="fa-fw fas fa-address-card">

                                    </i>
                                    <span>{{ trans('cruds.ownCar.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('own_car_form_access')
                            <li class="{{ request()->is("admin/own-car-forms") || request()->
                                is("admin/own-car-forms/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.own-car-forms.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>{{ trans('cruds.ownCarForm.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('menu_stand_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-car">

                            </i>
                            <span>{{ trans('cruds.menuStand.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('stand_item_access')
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa-fw fas fa-circle">

                                    </i>
                                    <span>{{ trans('cruds.standItem.title') }}</span>
                                    <span class="pull-right-container"><i
                                            class="fa fa-fw fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('fuel_access')
                                    <li class="{{ request()->is("admin/fuels") || request()->is("admin/fuels/*") ?
                                        "active" :
                                        "" }}">
                                        <a href="{{ route("admin.fuels.index") }}">
                                            <i class="fa-fw fas fa-circle">

                                            </i>
                                            <span>{{ trans('cruds.fuel.title') }}</span>

                                        </a>
                                    </li>
                                    @endcan
                                    @can('month_access')
                                    <li class="{{ request()->is("admin/months") || request()->is("admin/months/*") ?
                                        "active" :
                                        "" }}">
                                        <a href="{{ route("admin.months.index") }}">
                                            <i class="fa-fw fas fa-circle">

                                            </i>
                                            <span>{{ trans('cruds.month.title') }}</span>

                                        </a>
                                    </li>
                                    @endcan
                                    @can('origin_access')
                                    <li class="{{ request()->is("admin/origins") || request()->is("admin/origins/*") ?
                                        "active"
                                        : "" }}">
                                        <a href="{{ route("admin.origins.index") }}">
                                            <i class="fa-fw fas fa-circle">

                                            </i>
                                            <span>{{ trans('cruds.origin.title') }}</span>

                                        </a>
                                    </li>
                                    @endcan
                                    @can('status_access')
                                    <li class="{{ request()->is("admin/statuses") || request()->is("admin/statuses/*")
                                        ?
                                        "active" : "" }}">
                                        <a href="{{ route("admin.statuses.index") }}">
                                            <i class="fa-fw fas fa-circle">

                                            </i>
                                            <span>{{ trans('cruds.status.title') }}</span>

                                        </a>
                                    </li>
                                    @endcan
                                    @can('brand_access')
                                    <li class="{{ request()->is("admin/brands") || request()->is("admin/brands/*") ?
                                        "active" :
                                        "" }}">
                                        <a href="{{ route("admin.brands.index") }}">
                                            <i class="fa-fw fas fa-circle">

                                            </i>
                                            <span>{{ trans('cruds.brand.title') }}</span>

                                        </a>
                                    </li>
                                    @endcan
                                    @can('car_model_access')
                                    <li class="{{ request()->is("admin/car-models") || request()->
                                        is("admin/car-models/*") ?
                                        "active" : "" }}">
                                        <a href="{{ route("admin.car-models.index") }}">
                                            <i class="fa-fw fas fa-circle">

                                            </i>
                                            <span>{{ trans('cruds.carModel.title') }}</span>

                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @can('stand_car_access')
                            <li class="{{ request()->is("admin/stand-cars") || request()->is("admin/stand-cars/*") ?
                                "active" :
                                "" }}">
                                <a href="{{ route("admin.stand-cars.index") }}">
                                    <i class="fa-fw fas fa-car">

                                    </i>
                                    <span>{{ trans('cruds.standCar.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('stand_car_form_access')
                            <li class="{{ request()->is("admin/stand-car-forms") || request()->
                                is("admin/stand-car-forms/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.stand-car-forms.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>{{ trans('cruds.standCarForm.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('menu_courier_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-bicycle">

                            </i>
                            <span>{{ trans('cruds.menuCourier.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('courier_access')
                            <li class="{{ request()->is("admin/couriers") || request()->is("admin/couriers/*") ?
                                "active" : ""
                                }}">
                                <a href="{{ route("admin.couriers.index") }}">
                                    <i class="fa-fw fas fa-motorcycle">

                                    </i>
                                    <span>{{ trans('cruds.courier.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('courier_form_access')
                            <li class="{{ request()->is("admin/courier-forms") || request()->
                                is("admin/courier-forms/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.courier-forms.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>{{ trans('cruds.courierForm.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('menu_training_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-chalkboard-teacher">

                            </i>
                            <span>{{ trans('cruds.menuTraining.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('training_access')
                            <li class="{{ request()->is("admin/trainings") || request()->is("admin/trainings/*") ?
                                "active" :
                                "" }}">
                                <a href="{{ route("admin.trainings.index") }}">
                                    <i class="fa-fw fas fa-chalkboard-teacher">

                                    </i>
                                    <span>{{ trans('cruds.training.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('training_form_access')
                            <li class="{{ request()->is("admin/training-forms") || request()->
                                is("admin/training-forms/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.training-forms.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>{{ trans('cruds.trainingForm.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('product_management_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-shopping-cart">

                            </i>
                            <span>{{ trans('cruds.productManagement.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('product_category_access')
                            <li class="{{ request()->is("admin/product-categories") || request()->
                                is("admin/product-categories/*") ? "active" : "" }}">
                                <a href="{{ route("admin.product-categories.index") }}">
                                    <i class="fa-fw fas fa-folder">

                                    </i>
                                    <span>{{ trans('cruds.productCategory.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('product_tag_access')
                            <li class="{{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*")
                                ?
                                "active" : "" }}">
                                <a href="{{ route("admin.product-tags.index") }}">
                                    <i class="fa-fw fas fa-folder">

                                    </i>
                                    <span>{{ trans('cruds.productTag.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('product_access')
                            <li class="{{ request()->is("admin/products") || request()->is("admin/products/*") ?
                                "active" : ""
                                }}">
                                <a href="{{ route("admin.products.index") }}">
                                    <i class="fa-fw fas fa-shopping-cart">

                                    </i>
                                    <span>{{ trans('cruds.product.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('product_form_access')
                            <li class="{{ request()->is("admin/product-forms") || request()->
                                is("admin/product-forms/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.product-forms.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>{{ trans('cruds.productForm.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('menu_tranfer_tour_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-bus-alt">

                            </i>
                            <span>{{ trans('cruds.menuTranferTour.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('transfer_tour_access')
                            <li class="{{ request()->is("admin/transfer-tours") || request()->
                                is("admin/transfer-tours/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.transfer-tours.index") }}">
                                    <i class="fa-fw fas fa-shopping-cart">

                                    </i>
                                    <span>{{ trans('cruds.transferTour.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('transfer_form_access')
                            <li class="{{ request()->is("admin/transfer-forms") || request()->
                                is("admin/transfer-forms/*") ?
                                "active" : "" }}">
                                <a href="{{ route("admin.transfer-forms.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>{{ trans('cruds.transferForm.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('menu_consulting_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-user-tie">

                            </i>
                            <span>{{ trans('cruds.menuConsulting.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('consulting_access')
                            <li class="{{ request()->is("admin/consultings") || request()->is("admin/consultings/*") ?
                                "active"
                                : "" }}">
                                <a href="{{ route("admin.consultings.index") }}">
                                    <i class="fa-fw fas fa-user-tie">

                                    </i>
                                    <span>{{ trans('cruds.consulting.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('consulting_form_access')
                            <li class="{{ request()->is("admin/consulting-forms") || request()->
                                is("admin/consulting-forms/*")
                                ? "active" : "" }}">
                                <a href="{{ route("admin.consulting-forms.index") }}">
                                    <i class="fa-fw fas fa-address-book">

                                    </i>
                                    <span>{{ trans('cruds.consultingForm.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('legal_access')
                    <li class="{{ request()->is("admin/legals") || request()->is("admin/legals/*") ? "active" : "" }}">
                        <a href="{{ route("admin.legals.index") }}">
                            <i class="fa-fw fas fa-balance-scale">

                            </i>
                            <span>{{ trans('cruds.legal.title') }}</span>

                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('contracts_menu_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw fas fa-file-signature">

                    </i>
                    <span>{{ trans('cruds.contractsMenu.title') }}</span>
                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('statement_of_responsibility_access')
                    <li class="{{ request()->is("admin/statement-of-responsibilities") || request()->
                        is("admin/statement-of-responsibilities/*") ? "active" : "" }}">
                        <a href="{{ route("admin.statement-of-responsibilities.index") }}">
                            <i class="fa-fw fas fa-signature">

                            </i>
                            <span>{{ trans('cruds.statementOfResponsibility.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('contract_access')
                    <li class="{{ request()->is("admin/contracts") || request()->is("admin/contracts/*") ? "active" :
                        "" }}">
                        <a href="{{ route("admin.contracts.index") }}">
                            <i class="fa-fw fas fa-signature">

                            </i>
                            <span>{{ trans('cruds.contract.title') }}</span>

                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('admin_statement_responsibility_access')
            <li class="{{ request()->is("admin/admin-statement-responsibilities") || request()->
                is("admin/admin-statement-responsibilities/*") ? "active" : "" }}">
                <a href="{{ route("admin.admin-statement-responsibilities.index") }}">
                    <i class="fa-fw fas fa-signature">

                    </i>
                    <span>{{ trans('cruds.adminStatementResponsibility.title') }}</span>

                </a>
            </li>
            @endcan
            @can('admin_contract_access')
            <li class="{{ request()->is("admin/admin-contracts") || request()->is("admin/admin-contracts/*") ? "active"
                : "" }}">
                <a href="{{ route("admin.admin-contracts.index") }}">
                    <i class="fa-fw fas fa-signature">

                    </i>
                    <span>{{ trans('cruds.adminContract.title') }}</span>

                </a>
            </li>
            @endcan
            @can('vehicle_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa-fw fas fa-car">

                    </i>
                    <span>{{ trans('cruds.vehicle.title') }}</span>
                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    @can('vehicle_setting_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa-fw fas fa-cogs">

                            </i>
                            <span>{{ trans('cruds.vehicleSetting.title') }}</span>
                            <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            @can('vehicle_brand_access')
                            <li class="{{ request()->is("admin/vehicle-brands") || request()->
                                is("admin/vehicle-brands/*") ? "active" : "" }}">
                                <a href="{{ route("admin.vehicle-brands.index") }}">
                                    <i class="fa-fw fas fa-car">

                                    </i>
                                    <span>{{ trans('cruds.vehicleBrand.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('vehicle_model_access')
                            <li class="{{ request()->is("admin/vehicle-models") || request()->
                                is("admin/vehicle-models/*") ? "active" : "" }}">
                                <a href="{{ route("admin.vehicle-models.index") }}">
                                    <i class="fa-fw fas fa-car">

                                    </i>
                                    <span>{{ trans('cruds.vehicleModel.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('vehicle_event_type_access')
                            <li class="{{ request()->is("admin/vehicle-event-types") || request()->
                                is("admin/vehicle-event-types/*") ? "active" : "" }}">
                                <a href="{{ route("admin.vehicle-event-types.index") }}">
                                    <i class="fa-fw fas fa-calendar">

                                    </i>
                                    <span>{{ trans('cruds.vehicleEventType.title') }}</span>

                                </a>
                            </li>
                            @endcan
                            @can('vehicle_event_warning_time_access')
                            <li class="{{ request()->is("admin/vehicle-event-warning-times") || request()->
                                is("admin/vehicle-event-warning-times/*") ? "active" : "" }}">
                                <a href="{{ route("admin.vehicle-event-warning-times.index") }}">
                                    <i class="fa-fw fas fa-stopwatch">

                                    </i>
                                    <span>{{ trans('cruds.vehicleEventWarningTime.title') }}</span>

                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('vehicle_event_access')
                    <li class="{{ request()->is("admin/vehicle-events") || request()->is("admin/vehicle-events/*") ?
                        "active" : "" }}">
                        <a href="{{ route("admin.vehicle-events.index") }}">
                            <i class="fa-fw fas fa-calendar">

                            </i>
                            <span>{{ trans('cruds.vehicleEvent.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    @can('vehicle_item_access')
                    <li class="{{ request()->is("admin/vehicle-items") || request()->is("admin/vehicle-items/*") ?
                        "active" : "" }}">
                        <a href="{{ route("admin.vehicle-items.index") }}">
                            <i class="fa-fw fas fa-car">

                            </i>
                            <span>{{ trans('cruds.vehicleItem.title') }}</span>

                        </a>
                    </li>
                    @endcan
                    <li class="{{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ?
                        "active"
                        : "" }}">
                        <a href="{{ route("admin.systemCalendar") }}">
                            <i class="fas fa-fw fa-calendar">

                            </i>
                            <span>{{ trans('global.systemCalendar') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('company_expenses_menu_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-building">

                        </i>
                        <span>{{ trans('cruds.companyExpensesMenu.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('company_expense_access')
                            <li class="{{ request()->is("admin/company-expenses") || request()->is("admin/company-expenses/*") ? "active" : "" }}">
                                <a href="{{ route("admin.company-expenses.index") }}">
                                    <i class="fa-fw fas fa-euro-sign">

                                    </i>
                                    <span>{{ trans('cruds.companyExpense.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('weekly_expense_report_access')
                            <li class="{{ request()->is("admin/weekly-expense-reports") || request()->is("admin/weekly-expense-reports/*") ? "active" : "" }}">
                                <a href="/admin/weekly-expense-reports">
                                    <i class="fa-fw fas fa-file-pdf">

                                    </i>
                                    <span>{{ trans('cruds.weeklyExpenseReport.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('company_report_access')
                            <li class="{{ request()->is("admin/company-reports") || request()->is("admin/company-reports/*") ? "active" : "" }}">
                                <a href="{{ route("admin.company-reports.index") }}">
                                    <i class="fa-fw fas fa-file-contract">

                                    </i>
                                    <span>{{ trans('cruds.companyReport.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }}">
                <a href="{{ route("admin.messenger.index") }}">
                    <i class="fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                    <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
            <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                <a href="{{ route('profile.password.edit') }}">
                    <i class="fa-fw fas fa-key">
                    </i>
                    {{ trans('global.change_password') }}
                </a>
            </li>
            @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>