<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="">
                <a href="{{ route('front.dashboard') }}">
                    <svg id="Group_827" data-name="Group 827" xmlns="http://www.w3.org/2000/svg" width="15.299" height="15.299" viewBox="0 0 15.299 15.299">
                        <path id="Path_1530" data-name="Path 1530" d="M300.014,399.85v-9.826h9.827v.158q0,4.276,0,8.552a1.087,1.087,0,0,1-1.111,1.114q-4.276,0-8.552,0Z" transform="translate(-294.542 -384.551)" fill="#486eb8" />
                        <path id="Path_1531" data-name="Path 1531" d="M284.989,379.357v-2.487c0-.251,0-.5,0-.751A1.088,1.088,0,0,1,286.112,375q4.378,0,8.757,0h4.284a1.092,1.092,0,0,1,1.134,1.126q0,1.554,0,3.107v.127Z" transform="translate(-284.989 -374.996)" fill="#c1484a" />
                        <path id="Path_1532" data-name="Path 1532" d="M284.99,390.019h4.362v9.827H288.8q-1.331,0-2.663,0a1.1,1.1,0,0,1-1.151-1.161q0-4.216,0-8.432Z" transform="translate(-284.99 -384.548)" fill="#486eb8" />
                    </svg>

                    <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16.798" height="16.798" viewBox="0 0 16.798 16.798">
                        <g id="Group_884" data-name="Group 884" transform="translate(-326.632 -393.762)">
                            <path id="Path_1608" data-name="Path 1608" d="M341.544,393.762H330.851a1.522,1.522,0,0,0-1.527,1.518v10.7a1.526,1.526,0,0,0,1.525,1.528h10.7a1.526,1.526,0,0,0,1.522-1.528V395.29A1.527,1.527,0,0,0,341.544,393.762Zm-9.165,10.693v-1.528h5.346v1.528Zm7.638-3.055h-7.638v-1.528h7.638Zm0-3.055h-7.638v-1.527h7.638Z" transform="translate(0.363 0)" fill="#486eb8" />
                            <path id="Path_1609" data-name="Path 1609" d="M328.16,396.454v12.22h12.22V410.2H328.16a1.527,1.527,0,0,1-1.528-1.523v-12.22Z" transform="translate(0 0.364)" fill="#c1484a" />
                        </g>
                    </svg>
                    <span>Documents</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-down pull-right"></i>
                    </span>
                </a>
                <div class="treeview-menu" style="display: none;">
                    <h5>Documents</h5>
                    <ul>
                        <li><a href="{{ route('front.document-list') }}">My Documents <img class="icon" src="{{asset('public/front/images/file-plus.svg') }}"></a></li>
                        <li><a href="{{ route('front.encrypted-document-list') }}">Encrypted</a></li>
                        <li><a href="{{ route('front.smart-folder-list') }}">Smart Folder</a></li>
                    </ul>
                </div>
            </li>

            <li class="treeview">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16.798" height="16.798" viewBox="0 0 16.798 16.798">
                        <g id="Group_884" data-name="Group 884" transform="translate(-326.632 -393.762)">
                            <path id="Path_1608" data-name="Path 1608" d="M341.544,393.762H330.851a1.522,1.522,0,0,0-1.527,1.518v10.7a1.526,1.526,0,0,0,1.525,1.528h10.7a1.526,1.526,0,0,0,1.522-1.528V395.29A1.527,1.527,0,0,0,341.544,393.762Zm-9.165,10.693v-1.528h5.346v1.528Zm7.638-3.055h-7.638v-1.528h7.638Zm0-3.055h-7.638v-1.527h7.638Z" transform="translate(0.363 0)" fill="#486eb8" />
                            <path id="Path_1609" data-name="Path 1609" d="M328.16,396.454v12.22h12.22V410.2H328.16a1.527,1.527,0,0,1-1.528-1.523v-12.22Z" transform="translate(0 0.364)" fill="#c1484a" />
                        </g>
                    </svg>
                    <span>In out Box</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-down pull-right"></i>
                    </span>
                </a>
                <div class="treeview-menu" style="display: none;">
                    <h5>Inbox</h5>
                    <ul>
                        <li><a href="">Shared with me</a></li>
                    </ul>
                    <h5>Outbox</h5>
                    <ul>
                        <li><a href="{{ route('front.out-usps-mail-list') }}">USPS Mail</a></li>
                        <li><a href="{{ route('front.out-share-list') }}">Share</a></li>
                        <li><a href="{{ route('front.out-send-for-review-list') }}">Send for Review</a></li>
                        <li><a href="{{ route('front.out-link-to-fill-list') }}">Link to Fill</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.351" height="16.516" viewBox="0 0 18.351 16.516">
                        <g id="Group_831" data-name="Group 831" transform="translate(0 0)">
                            <path id="Path_1544" data-name="Path 1544" d="M286.152,404.991q4.112,0,8.225,0a.883.883,0,0,1,.947.94c-.021.254-.054.506-.082.76q-.167,1.528-.334,3.057c-.089.817-.174,1.634-.271,2.449a.877.877,0,0,1-.911.736q-1.817,0-3.634,0-5.71,0-11.419,0a1.548,1.548,0,0,1-.341-.032.849.849,0,0,1-.671-.762q-.3-2.734-.6-5.469-.039-.352-.077-.7a.879.879,0,0,1,.908-.976q2.075,0,4.151,0Zm2.83,4.264h-5.66c.042-.15.085-.288.12-.429a.621.621,0,0,0-1.188-.363c-.134.418-.261.838-.376,1.262a.614.614,0,0,0,.592.776c.089,0,.178,0,.268,0h7.04a.613.613,0,0,0,.655-.741c-.113-.45-.253-.894-.4-1.333a.6.6,0,0,0-.764-.361.61.61,0,0,0-.408.741C288.893,408.949,288.935,409.089,288.982,409.255Z" transform="translate(-276.976 -396.419)" fill="#486eb8" />
                            <path id="Path_1545" data-name="Path 1545" d="M296.771,385.831c-.375,0-.726-.006-1.076,0-.129,0-.138-.081-.166-.164l-1.094-3.278c-.214-.64-.431-1.279-.638-1.921a.189.189,0,0,0-.217-.154q-4.733,0-9.467,0c-.172,0-.211.084-.254.213-.561,1.691-1.128,3.38-1.683,5.073-.06.185-.139.246-.331.234-.3-.018-.611,0-.94,0,.023-.093.038-.171.061-.246q1.13-3.676,2.262-7.35c.1-.309.146-.346.477-.346h10.309c.267,0,.338.049.415.3q1.156,3.747,2.308,7.495C296.75,385.723,296.757,385.767,296.771,385.831Z" transform="translate(-279.662 -377.888)" fill="#486eb8" />
                            <path id="Path_1546" data-name="Path 1546" d="M299.606,400.379H288.623c.1-.386.2-.761.313-1.131.012-.039.124-.067.189-.067q1.731-.006,3.462,0,3.242,0,6.484,0c.159,0,.236.037.273.2C299.416,399.71,299.515,400.038,299.606,400.379Z" transform="translate(-284.94 -392.443)" fill="#c1484a" />
                            <path id="Path_1547" data-name="Path 1547" d="M299.863,393.377l.326,1.2h-9.982c.106-.385.205-.763.32-1.138.01-.034.116-.055.177-.055q1.616-.006,3.232,0h5.926Z" transform="translate(-286.023 -388.478)" fill="#c1484a" />
                            <path id="Path_1548" data-name="Path 1548" d="M300.45,387.587l.324,1.191H291.8l.322-1.191Z" transform="translate(-287.108 -384.52)" fill="#c1484a" />
                        </g>
                    </svg>
                    <span>Track</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15.748" height="18" viewBox="0 0 15.748 18">
                        <g id="Group_885" data-name="Group 885" transform="translate(-273.621 -393.372)">
                            <path id="Path_1610" data-name="Path 1610" d="M273.621,396.326v-.985a.842.842,0,0,1,.839-.844H278.4l.331-.658a.834.834,0,0,1,.753-.468H283.5a.843.843,0,0,1,.755.468l.331.658h3.937a.842.842,0,0,1,.844.839v.99a.423.423,0,0,1-.422.422H274.042A.423.423,0,0,1,273.621,396.326Z" transform="translate(0)" fill="#c1484a" />
                            <path id="Path_1611" data-name="Path 1611" d="M287.623,397.074H274.968a.423.423,0,0,0-.422.422v11.39a1.687,1.687,0,0,0,1.688,1.688h10.124a1.688,1.688,0,0,0,1.688-1.688V397.5h0A.425.425,0,0,0,287.623,397.074Zm-9.139,10.681a.563.563,0,0,1-1.125,0v-7.869a.563.563,0,0,1,1.125,0Zm3.375,0a.563.563,0,0,1-1.125,0v-7.869a.563.563,0,0,1,1.125,0Zm3.375,0a.563.563,0,0,1-1.125,0v-7.869a.563.563,0,0,1,1.125,0Z" transform="translate(0.2 0.799)" fill="#486eb8" />
                        </g>
                    </svg>
                    <span>Messages</span>
                </a>
            </li>

            <li>
                <a href="{{ route('front.trash-list') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15.748" height="18" viewBox="0 0 15.748 18">
                        <g id="Group_885" data-name="Group 885" transform="translate(-273.621 -393.372)">
                            <path id="Path_1610" data-name="Path 1610" d="M273.621,396.326v-.985a.842.842,0,0,1,.839-.844H278.4l.331-.658a.834.834,0,0,1,.753-.468H283.5a.843.843,0,0,1,.755.468l.331.658h3.937a.842.842,0,0,1,.844.839v.99a.423.423,0,0,1-.422.422H274.042A.423.423,0,0,1,273.621,396.326Z" transform="translate(0)" fill="#c1484a" />
                            <path id="Path_1611" data-name="Path 1611" d="M287.623,397.074H274.968a.423.423,0,0,0-.422.422v11.39a1.687,1.687,0,0,0,1.688,1.688h10.124a1.688,1.688,0,0,0,1.688-1.688V397.5h0A.425.425,0,0,0,287.623,397.074Zm-9.139,10.681a.563.563,0,0,1-1.125,0v-7.869a.563.563,0,0,1,1.125,0Zm3.375,0a.563.563,0,0,1-1.125,0v-7.869a.563.563,0,0,1,1.125,0Zm3.375,0a.563.563,0,0,1-1.125,0v-7.869a.563.563,0,0,1,1.125,0Z" transform="translate(0.2 0.799)" fill="#486eb8" />
                        </g>
                    </svg>
                    <span>Trash</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu secound-menu" data-widget="tree">
            <!-- <li class="header">NAVIGATION</li> -->
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18.463" height="19.529" viewBox="0 0 18.463 19.529">
                        <g id="Group_872" data-name="Group 872" transform="translate(-266.745 -388.208)">
                            <path id="Path_1593" data-name="Path 1593" d="M270.319,395.387c0,.578,0,1.134,0,1.69a.885.885,0,0,0,.986.982h5.449a.884.884,0,0,0,.975-.973q0-.836,0-1.672a.486.486,0,0,1,.016-.071h3.07c.328,0,.424.094.424.418,0,1.3,0,2.609,0,3.914,0,.184-.035.256-.239.276a4.243,4.243,0,0,0-1.526,7.914.213.213,0,0,1,.118.217q-.006,1.436,0,2.872a4.451,4.451,0,0,0,.027.745,5.347,5.347,0,0,0,.229.722c-.042,0-.1.013-.151.013H267.152c-.314,0-.407-.1-.407-.413q0-8.123,0-16.246c0-.3.1-.4.382-.4h3.01C270.188,395.378,270.24,395.383,270.319,395.387Zm3.942,12.9h2.222c.2,0,.407.005.609,0a.291.291,0,0,0,.306-.292.307.307,0,0,0-.29-.313,1.8,1.8,0,0,0-.2,0h-5.25a2.289,2.289,0,0,0-.255.006.268.268,0,0,0-.261.289.289.289,0,0,0,.246.309.854.854,0,0,0,.2.008Zm.188-6.6h2.833a1.071,1.071,0,0,0,.2-.008.3.3,0,0,0,0-.591.809.809,0,0,0-.177-.006h-5.764a.651.651,0,0,0-.157.007.285.285,0,0,0-.239.294.274.274,0,0,0,.236.293,1.056,1.056,0,0,0,.215.012Zm-.463,8.18h0c-.832,0-1.665,0-2.5,0a.3.3,0,0,0-.344.317c0,.179.133.292.345.3.19,0,.38,0,.57,0h4.425a.343.343,0,0,0,.362-.313c.007-.171-.142-.3-.363-.3C275.651,409.868,274.818,409.869,273.986,409.869Zm-.464-5.984h2c.263,0,.4-.1.4-.3s-.133-.307-.389-.308h-4.009c-.236,0-.379.114-.384.3s.129.3.372.3C272.185,403.886,272.853,403.885,273.522,403.885Zm.033,2.2c.668,0,1.336,0,2,0,.24,0,.371-.114.367-.309s-.129-.294-.362-.294q-2.014,0-4.029,0c-.25,0-.392.119-.389.313s.136.291.385.291Zm-4.426,4.4v0c.078,0,.157,0,.235,0a.282.282,0,0,0,.306-.285.286.286,0,0,0-.271-.322,3.859,3.859,0,0,0-.567,0,.3.3,0,0,0,0,.605A2.4,2.4,0,0,0,269.128,410.482Zm0-9.429v0c-.091,0-.183-.005-.274,0a.3.3,0,0,0-.3.316.294.294,0,0,0,.3.293c.175.009.352.008.528,0a.271.271,0,0,0,.287-.282.3.3,0,0,0-.269-.326A2.254,2.254,0,0,0,269.126,401.052Zm0,7.231h0c.078,0,.157,0,.235,0a.277.277,0,0,0,.309-.28.288.288,0,0,0-.288-.325,4.939,4.939,0,0,0-.548,0,.269.269,0,0,0-.281.287.3.3,0,0,0,.28.316C268.928,408.291,269.026,408.283,269.124,408.283Zm0-2.2h0c.085,0,.171,0,.256,0a.268.268,0,0,0,.29-.278.283.283,0,0,0-.273-.32,5.043,5.043,0,0,0-.57,0,.283.283,0,0,0-.276.3.293.293,0,0,0,.278.3C268.926,406.09,269.024,406.083,269.123,406.083Zm-.01-2.8h0c-.085,0-.17,0-.255,0a.291.291,0,0,0-.308.307.287.287,0,0,0,.3.292c.176.007.353.006.53,0a.279.279,0,0,0,.287-.285.291.291,0,0,0-.281-.314C269.3,403.278,269.205,403.284,269.113,403.284Z" transform="translate(0 -5.004)" fill="#98a2c5" />
                            <path id="Path_1594" data-name="Path 1594" d="M283.684,392.474q-1.357,0-2.714,0c-.32,0-.422-.1-.423-.424q0-.9,0-1.809c0-.291.1-.383.391-.384.229,0,.459-.005.689,0,.115,0,.168-.023.2-.151a1.919,1.919,0,0,1,1.874-1.5,1.894,1.894,0,0,1,1.852,1.494c.028.122.074.16.2.156.242-.008.485,0,.728,0s.354.1.356.342q.007.963,0,1.927c0,.249-.11.346-.371.347Q285.071,392.476,283.684,392.474Zm1.264-2.656a1.279,1.279,0,0,0-1.315-1.031,1.25,1.25,0,0,0-1.2,1.031Z" transform="translate(-9.678 0)" fill="#98a2c5" />
                            <path id="Path_1595" data-name="Path 1595" d="M311.359,416.38a3.662,3.662,0,1,1-3.688-3.658A3.675,3.675,0,0,1,311.359,416.38Zm-.577.006a3.1,3.1,0,0,0-3.088-3.113,3.082,3.082,0,1,0,3.088,3.113Z" transform="translate(-26.151 -17.192)" fill="#98a2c5" />
                            <path id="Path_1596" data-name="Path 1596" d="M311.812,438.491a4.436,4.436,0,0,0,2.666,0c0,.207,0,.389,0,.571,0,.884.016,1.768-.006,2.652a1.329,1.329,0,0,1-1.912,1.152,1.253,1.253,0,0,1-.758-1.133c-.021-1.054-.007-2.108-.006-3.162A.408.408,0,0,1,311.812,438.491Z" transform="translate(-31.591 -35.26)" fill="#98a2c5" />
                        </g>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16.761" height="20.004" viewBox="0 0 16.761 20.004">
                        <path id="Path_1597" data-name="Path 1597" d="M0,20a6.281,6.281,0,0,1,6.269-6.272h4.2A6.32,6.32,0,0,1,16.761,20ZM8.371,3.823a4.346,4.346,0,0,1,3.144,7.35H10a1.353,1.353,0,0,0-.877-.311h-1.5a1.424,1.424,0,0,0-1.371,1.115,4.354,4.354,0,0,1,2.12-8.155ZM14.86,8.5c0,.018-.018.018-.037.037a2.043,2.043,0,0,1-.585,1.188l-.055.055V11.3a2.184,2.184,0,0,1-.073.53,1.208,1.208,0,0,1-.219.4.974.974,0,0,1-.366.238,1.068,1.068,0,0,1-.347.073H9.651a.63.63,0,0,1-.53.311h-1.5a.6.6,0,0,1-.6-.585.589.589,0,0,1,.585-.585H9.1a.607.607,0,0,1,.53.311h3.381a.927.927,0,0,0,.238-.037.4.4,0,0,0,.146-.091.514.514,0,0,0,.091-.2,1.843,1.843,0,0,0,.037-.347V10.167a1.605,1.605,0,0,1-.274.091.686.686,0,0,0,.018-.2V6.529a.891.891,0,0,0-.018-.219,2.2,2.2,0,0,1,.9.53c.018.018.055.037.073.073V6.766a6.272,6.272,0,0,0-.091-1.024,9.049,9.049,0,0,0-.274-1.006,7.288,7.288,0,0,0-.439-.933,5.325,5.325,0,0,0-.585-.841c-.018-.018-.018-.055-.037-.073a.519.519,0,0,1-.439-.146,5.691,5.691,0,0,0-8.042,0,.54.54,0,0,1-.439.146.139.139,0,0,1-.037.073,5.322,5.322,0,0,0-.585.841,4.347,4.347,0,0,0-.439.933,4.374,4.374,0,0,0-.274.987,6.271,6.271,0,0,0-.091,1.024v.146l.073-.073a1.954,1.954,0,0,1,.9-.53A.891.891,0,0,0,3.4,6.51v3.547a.821.821,0,0,0,.018.2,2.205,2.205,0,0,1-.9-.53A2.043,2.043,0,0,1,1.937,8.54c0-.018-.018-.018-.037-.037a.3.3,0,0,1-.091-.219V6.766A5.813,5.813,0,0,1,1.9,5.633a5.894,5.894,0,0,1,.292-1.115,9.1,9.1,0,0,1,.493-1.042,5.389,5.389,0,0,1,.658-.933.322.322,0,0,1,.091-.073.557.557,0,0,1,.146-.494A6.782,6.782,0,0,1,8.371,0a6.709,6.709,0,0,1,4.771,1.975.557.557,0,0,1,.146.494.182.182,0,0,1,.091.073,5.386,5.386,0,0,1,.658.933,5.44,5.44,0,0,1,.494,1.042c.128.366.219.731.329,1.115a7.7,7.7,0,0,1,.091,1.134V8.284A.338.338,0,0,1,14.86,8.5Z" transform="translate(0 -0.001)" fill="#98a2c5" fill-rule="evenodd" />
                    </svg>
                    <span>Tests</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20.539" height="16.399" viewBox="0 0 20.539 16.399">
                        <g id="Group_871" data-name="Group 871" transform="translate(-263.362 -393.54)">
                            <path id="Path_1589" data-name="Path 1589" d="M277.956,395.073l-.472,1.634c-.363-.206-.7-.421-1.061-.6a8.976,8.976,0,0,0-4.719-.87,8.413,8.413,0,0,0-4.166,1.4,5.389,5.389,0,0,0-2.341,3.086,4.582,4.582,0,0,0,1.3,4.548,7.2,7.2,0,0,0,1.789,1.327.251.251,0,0,1,.142.311,7.541,7.541,0,0,1-.7,2.2c-.015.03-.023.063-.047.128.119-.03.214-.052.309-.079a5.579,5.579,0,0,0,2.685-1.579.381.381,0,0,1,.39-.1,9.311,9.311,0,0,0,2.065.083,9.777,9.777,0,0,0,2.051-.379c.057-.017.116-.031.2-.054.05.3.1.588.144.876.033.2.062.405.1.607a.154.154,0,0,1-.13.206,10.833,10.833,0,0,1-3.875.387.517.517,0,0,0-.4.137,7.591,7.591,0,0,1-3.453,1.566,1.445,1.445,0,0,1-1.477-.6,1.529,1.529,0,0,1-.181-1.66c.143-.317.279-.638.427-.953.065-.138.031-.214-.092-.3a7.226,7.226,0,0,1-2.323-2.612,5.987,5.987,0,0,1,.433-6.476,8.263,8.263,0,0,1,4.491-3.206,10.658,10.658,0,0,1,8.534.751C277.7,394.915,277.818,394.992,277.956,395.073Z" transform="translate(0 0)" fill="#98a2c5" />
                            <path id="Path_1590" data-name="Path 1590" d="M307.1,406.209c.09-.335.176-.671.271-1,.866-3.006,1.74-6.01,2.594-9.02a1.017,1.017,0,0,1,1.319-.719c.789.247,1.586.464,2.38.693a.976.976,0,0,1,.726,1.325q-.945,3.268-1.885,6.537c-.29,1-.589,2.006-.868,3.013a2.454,2.454,0,0,1-.6.942q-1.023,1.178-2.049,2.352a1.928,1.928,0,0,1-.187.19.621.621,0,0,1-1.046-.318c-.094-.39-.147-.791-.21-1.188-.134-.849-.264-1.7-.394-2.549-.012-.081-.017-.163-.024-.244Zm6.276-8.632c0-.41-.1-.577-.388-.667-.495-.155-.992-.3-1.494-.436a.551.551,0,0,0-.723.4c-.1.3-.174.618-.27.924-.041.132,0,.189.125.222.185.049.368.1.551.158.551.16,1.1.323,1.654.474.073.02.224-.006.237-.044C313.19,398.231,313.293,397.849,313.372,397.577Zm-5.17,9.248a.454.454,0,0,0-.033.1c.039.517.076,1.034.126,1.55.005.052.084.121.143.141.193.068.395.109.588.176a.245.245,0,0,0,.327-.11c.243-.356.5-.7.748-1.053.042-.059.077-.122.137-.219Z" transform="translate(-30.545 -1.307)" fill="#98a2c5" />
                            <path id="Path_1591" data-name="Path 1591" d="M293.871,413.133a1.448,1.448,0,0,1,1.436,1.435,1.455,1.455,0,1,1-2.911,0A1.426,1.426,0,0,1,293.871,413.133Z" transform="translate(-20.278 -13.684)" fill="#98a2c5" />
                            <path id="Path_1592" data-name="Path 1592" d="M279.328,414.577a1.426,1.426,0,0,1-1.462,1.445,1.452,1.452,0,0,1-1.421-1.432,1.441,1.441,0,1,1,2.882-.014Z" transform="translate(-9.138 -13.683)" fill="#98a2c5" />
                        </g>
                    </svg>
                    <span>Tests</span>
                </a>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>