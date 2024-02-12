<template>
    <div class="dropdown ms-sm-3 header-item topbar-user">
        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <span class="d-flex align-items-center">
                <img class="rounded-circle header-profile-user" src="/images/users/avatar-1.jpg"
                    alt="Header Avatar" />
                <span class="text-start ms-xl-2">
                    <span class=" d-none d-xl-inline-block ms-1 fw-medium user-name-text">Anna Adame</span>
                    <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Founder</span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end" style="cursor: pointer;">
            <h6 class="dropdown-header">Welcome Anna!</h6>
            <Link class="dropdown-item" to="/pages/profile"><i
                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Profile</span>
            </Link>
            <Link class="dropdown-item" to="/chat">
                <i class=" mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Messages</span>
            </Link>
            <Link class="dropdown-item" to="/apps/tasks-kanban">
                <i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Taskboard</span>
            </Link>
            <Link class="dropdown-item" to="/pages/faqs"><i
                    class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Help</span>
            </Link>
            <div class="dropdown-divider"></div>
            <Link class="dropdown-item" to="/pages/profile"><i
                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Balance : <b>$5971.67</b></span>
            </Link>
            <Link class="dropdown-item" to="/pages/profile-setting">
                <b-badge variant="soft-success" class="bg-soft-success text-success mt-1 float-end">New</b-badge><i
                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Settings</span>
            </Link>
            <Link class="dropdown-item" to="/auth/lockscreen-basic"><i
                    class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">Lock screen</span>
            </Link>
            <b-link class="dropdown-item" href="/logout"><i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle" data-key="t-logout">Logout</span>
            </b-link>
        </div>
    </div>
</template>
