<template>
<div class="dropdown topbar-head-dropdown ms-1 header-item">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bx bx-category-alt fs-22"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
            <b-row class="align-items-center">
                <b-col>
                    <h6 class="m-0 fw-semibold fs-15">Web Apps</h6>
                </b-col>
                <b-col cols="auto">
                    <b-link href="#!" class="btn btn-sm btn-soft-info">View All Apps<i class="ri-arrow-right-s-line align-middle"></i></b-link>
                </b-col>
            </b-row>
        </div>

        <div class="p-2">
            <b-row class="g-0">
                <b-col>
                    <b-link class="dropdown-icon-item" href="#!">
                        <img src="/images/brands/github.png" alt="Github" />
                        <span>GitHub</span>
                    </b-link>
                </b-col>
                <b-col>
                    <b-link class="dropdown-icon-item" href="#!">
                        <img src="/images/brands/bitbucket.png" alt="bitbucket" />
                        <span>Bitbucket</span>
                    </b-link>
                </b-col>
                <b-col>
                    <b-link class="dropdown-icon-item" href="#!">
                        <img src="/images/brands/dribbble.png" alt="dribbble" />
                        <span>Dribbble</span>
                    </b-link>
                </b-col>
                </b-row>

                <b-row class="g-0">
                <b-col>
                    <b-link class="dropdown-icon-item" href="#!">
                        <img src="/images/brands/dropbox.png" alt="dropbox" />
                        <span>Dropbox</span>
                    </b-link>
                </b-col>
                <b-col>
                    <b-link class="dropdown-icon-item" href="#!">
                        <img src="/images/brands/mail_chimp.png" alt="mail_chimp" />
                        <span>Mail Chimp</span>
                    </b-link>
                </b-col>
                <b-col>
                    <b-link class="dropdown-icon-item" href="#!">
                        <img src="/images/brands/slack.png" alt="slack" />
                        <span>Slack</span>
                    </b-link>
                </b-col>
            </b-row>
        </div>
    </div>
</div>
</template>