<template>
    <div class="dropdown topbar-head-dropdown ms-1 header-item">
        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
            <i class='bx bx-shopping-bag fs-22'></i>
            <span class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info">5</span>
        </button>
        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart" aria-labelledby="page-header-cart-dropdown">
            <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                <b-row class="align-items-center">
                    <b-col>
                        <h6 class="m-0 fs-16 fw-semibold"> My Cart</h6>
                    </b-col>
                    <b-col cols="auto">
                        <b-badge variant="soft-warning" class="badge-soft-warning fs-13"><span class="cartitem-badge">7</span>items</b-badge>
                    </b-col>
                </b-row>
            </div>
            <SimpleBar data-simplebar style="max-height: 300px">
                <div class="p-2">
                    <div class="text-center empty-cart" id="empty-cart">
                        <div class="avatar-md mx-auto my-3">
                            <div class="avatar-title bg-soft-info text-info fs-36 rounded-circle">
                                <i class='bx bx-cart'></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Your Cart is Empty!</h5>
                        <b-link href="/ecommerce/products" class="btn btn-success w-md mb-3">Shop Now</b-link>
                    </div>
                    <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                        <div class="d-flex align-items-center">
                            <img src="/images/products/img-1.png" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mt-0 mb-1 fs-14"><b-link href="/ecommerce/product-details" class="text-reset">Branded T-Shirts</b-link></h6>
                                <p class="mb-0 fs-12 text-muted">Quantity: <span>10 x $32</span></p>
                            </div>
                            <div class="px-2">
                                <h5 class="m-0 fw-normal">$<span class="cart-item-price">320</span></h5>
                            </div>
                            <div class="ps-2">
                                <b-button type="button" variant="ghost-secondary" size="sm"
                                class="btn btn-icon remove-item-btn"><i class="ri-close-fill fs-16"></i></b-button>
                            </div>
                        </div>
                    </div>

                    <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                        <div class="d-flex align-items-center">
                            <img src="/images/products/img-2.png" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mt-0 mb-1 fs-14"><b-link href="/ecommerce/product-details" class="text-reset">Bentwood Chair</b-link></h6>
                                <p class="mb-0 fs-12 text-muted">Quantity: <span>5 x $18</span></p>
                            </div>
                            <div class="px-2">
                                <h5 class="m-0 fw-normal">$<span class="cart-item-price">89</span></h5>
                            </div>
                            <div class="ps-2">
                                <b-button type="button" variant="ghost-secondary" size="sm"
                                class="btn btn-icon remove-item-btn"><i class="ri-close-fill fs-16"></i></b-button>
                            </div>
                        </div>
                    </div>

                    <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                        <div class="d-flex align-items-center">
                            <img src="/images/products/img-3.png" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mt-0 mb-1 fs-14"><b-link href="/ecommerce/product-details" class="text-reset">Borosil Paper Cup</b-link></h6>
                                <p class="mb-0 fs-12 text-muted">Quantity: <span>3 x $250</span> </p>
                            </div>
                            <div class="px-2">
                                <h5 class="m-0 fw-normal">$<span class="cart-item-price">750</span></h5>
                            </div>
                            <div class="ps-2">
                                <b-button type="button" variant="ghost-secondary" size="sm" class="btn btn-icon remove-item-btn"><i class="ri-close-fill fs-16"></i></b-button>
                            </div>
                        </div>
                    </div>

                    <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                        <div class="d-flex align-items-center">
                        <img src="/images/products/img-6.png" class="me-3 rounded-circle avatar-sm p-2 bg-light"
                            alt="user-pic">
                        <div class="flex-1">
                            <h6 class="mt-0 mb-1 fs-14"><b-link href="/ecommerce/product-details" class="text-reset">Gray Styled T-Shirt</b-link></h6>
                            <p class="mb-0 fs-12 text-muted">Quantity: <span>1 x $1250</span></p>
                        </div>
                        <div class="px-2">
                            <h5 class="m-0 fw-normal">$ <span class="cart-item-price">1250</span></h5>
                        </div>
                        <div class="ps-2">
                            <b-button type="button" variant="ghost-secondary" size="sm"
                            class="btn btn-icon remove-item-btn"><i class="ri-close-fill fs-16"></i></b-button>
                        </div>
                        </div>
                    </div>

                    <div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                        <div class="d-flex align-items-center">
                            <img src="/images/products/img-5.png" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mt-0 mb-1 fs-14"><b-link href="/ecommerce/product-details" class="text-reset">Stillbird Helmet</b-link></h6>
                                <p class="mb-0 fs-12 text-muted"> Quantity: <span>2 x $495</span></p>
                            </div>
                            <div class="px-2">
                                <h5 class="m-0 fw-normal">$<span class="cart-item-price">990</span></h5>
                            </div>
                            <div class="ps-2">
                                <b-button type="button" variant="ghost-secondary" size="sm"
                                class="btn btn-icon remove-item-btn"><i class="ri-close-fill fs-16"></i></b-button>
                            </div>
                        </div>
                    </div>
                </div>
            </SimpleBar>
            <div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border" id="checkout-elem">
                <div class="d-flex justify-content-between align-items-center pb-3">
                    <h5 class="m-0 text-muted">Total:</h5>
                    <div class="px-2"> <h5 class="m-0" id="cart-item-total">$1258.58</h5></div>
                </div>
                <b-link href="/ecommerce/checkout" class="btn btn-success text-center w-100">Checkout</b-link>
            </div>
        </div>
    </div>
</template>
<script>
import { SimpleBar } from "simplebar-vue3";
export default {
    components : { SimpleBar }
}
</script>