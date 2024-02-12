<template>
    <div>
        <div class="app-menu navbar-menu" style="background-color: #11101d;">
            <div class="navbar-brand-box" style="background-color: #11101d;">
                <Link href='/' class="logo logo-dark">
                    <span class="logo-sm">
                        <!-- <img src="/images/logo.png" alt="" height="30" /> -->
                    </span>
                    <span class="logo-lg">
                        <!-- <img src="/images/logo-dark.png" alt="" height="17" /> -->
                    </span>
                </Link>
                <Link href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <!-- <img src="/images/logo.png" alt="" height="30" /> -->
                    </span>
                    <span class="logo-lg">
                        <!-- <img src="/images/logo-light.png" alt="" height="17" /> -->
                    </span>
                </Link>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover" @click="initActiveMenu">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

             <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item" v-if="hasRole('Home')" >
                    <Link class="nav-link menu-link" :class="{ 'active': $page.url === '/home' }" href="/home">
                        <i class='ri ri-apps-line '></i>
                        <span data-key="t-dashboards">Home</span>
                    </Link>
                </li>
                <li class="nav-item" v-if="hasRole('Cashiering')">
                    <Link class="nav-link menu-link" :class="{ 'active': $page.url === '/sales' }" href="/sales">
                        <i class='ri ri-hand-coin-fill'></i>
                        <span data-key="t-dashboards">Cashiering</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <b-link class="nav-link menu-link"  href="#sidebarDashboards1" :class="{'active': $page.component.startsWith('Modules/Inventory') }" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards1">
                        <i class="ri-archive-fill"></i>
                        <span data-key="t-dashboards">Inventory</span>
                    </b-link>
                    <div class="collapse menu-dropdown" id="sidebarDashboards1">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item" v-if="hasRole('Product Management')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Inventory/Products') }" href="/products">
                                    <span data-key="t-dashboards">Product Management</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Package Management')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Inventory/Packages') }" href="/packages">
                                    <span data-key="t-dashboards">Package Management</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Customer Return')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Inventory/Customer') }" href="/customer">
                                    <span data-key="t-dashboards">Customer Return</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Supplier Return')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Inventory/Supplier') }" href="/supplier">
                                    <span data-key="t-dashboards">Supplier Return</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <b-link class="nav-link menu-link"  href="#sidebarDashboards2" :class="{'active': $page.component.startsWith('Modules/Stocking') }" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards2">
                        <i class="ri-server-fill"></i>
                        <span data-key="t-dashboards">Product Stocking</span>
                    </b-link>
                    <div class="collapse menu-dropdown" id="sidebarDashboards2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item" v-if="hasRole('Purchased Order')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Stocking/Orders') }" href="/orders">
                                    <span data-key="t-dashboards">Purchased Order</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Deliveries')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Stocking/Deliveries') }" href="/deliveries">
                                    <span data-key="t-dashboards">Deliveries</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <b-link class="nav-link menu-link"  href="#sidebarDashboards7" :class="{'active': $page.component.startsWith('Modules/Reports') }" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards1">
                        <i class="ri-file-text-fill"></i>
                        <span data-key="t-dashboards">Reports</span>
                    </b-link>
                    <div class="collapse menu-dropdown" id="sidebarDashboards7">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item" v-if="hasRole('Inventory Report')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility') }" href="/reports/inventory">
                                    <span data-key="t-dashboards">Inventory Report</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Re-order Report')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility') }" href="/reports/reorders">
                                    <span data-key="t-dashboards">Re-order Report</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Sales Report')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility') }" href="/reports/sales">
                                    <span data-key="t-dashboards">Sales Report</span>
                                </Link>
                            </li>
                             <li class="nav-item" v-if="hasRole('Delivery Report')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility') }" href="/reports/orders">
                                    <span data-key="t-dashboards">Delivery Report</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Stock Adjustment Report')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility') }" href="/reports/adjustments">
                                    <span data-key="t-dashboards">Stock Adjustment Report</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Customer Return Report')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility') }" href="/reports/customers">
                                    <span data-key="t-dashboards">Customer Return Report</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Supplier Return Report')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility') }" href="/reports/suppliers">
                                    <span data-key="t-dashboards">Supplier Return Report</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <b-link class="nav-link menu-link"  href="#sidebarDashboards3" :class="{'active': $page.component.startsWith('Modules/Utility') }" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards3">
                        <i class="ri-database-2-fill"></i>
                        <span data-key="t-dashboards">Utility</span>
                    </b-link>
                    <div class="collapse menu-dropdown" id="sidebarDashboards3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item" v-if="hasRole('User Management')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility/Users') }" href="/users">
                                    <span data-key="t-dashboards">User Management</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Backup and Restore')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility/Backups') }" href="/backups">
                                    <span data-key="t-dashboards">Backup and Restore</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Role Management')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Utility/Roles') }" href="/roles">
                                    <span data-key="t-dashboards">Role Management</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <b-link class="nav-link menu-link"  href="#sidebarDashboards4" :class="{'active': $page.component.startsWith('Modules/Maintenance') }" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards4">
                        <i class="ri-settings-5-fill"></i>
                        <span data-key="t-dashboards">Maintenance</span>
                    </b-link>
                    <div class="collapse menu-dropdown" id="sidebarDashboards4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item" v-if="hasRole('Customers')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Maintenance/Customers') }" href="/customers">
                                    <span data-key="t-dashboards">Customers</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Suppliers')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Maintenance/Suppliers') }" href="/suppliers">
                                    <span data-key="t-dashboards">Suppliers</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Pricing')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Maintenance/Pricings') }" href="/pricings">
                                    <span data-key="t-dashboards">Pricing</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Discount')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Maintenance/Discounts') }" href="/discounts">
                                    <span data-key="t-dashboards">Discount</span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Category and Unit')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Maintenance/Settings') }" href="/settings">
                                    <span data-key="t-dashboards">Category and Unit </span>
                                </Link>
                            </li>
                            <li class="nav-item" v-if="hasRole('Terms and Conditions')">
                                <Link class="nav-link" :class="{'active': $page.component.startsWith('Modules/Maintenance/Terms') }" href="/terms">
                                    <span data-key="t-dashboards">Terms & Conditions</span>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <div class="sidebar-background"></div>
        </div>
        <div class="vertical-overlay" id="overlay"></div>
    </div>
</template>
<script>
export default {
    props: ['role','role_menus'],
    methods: {
        hasRole(r) {
            if(this.role == 'Administrator'){
                return true;
            }else{
                const arrayOfIds = this.role_menus.map(obj => obj.name);
                return arrayOfIds.includes(r);
            }
        },
    },
}
</script>