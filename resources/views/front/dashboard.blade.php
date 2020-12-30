@extends('layouts.front-user')
@section("content")

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">


		<!-- Sidebar Menu -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">NAVIGATION</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="active treeview">
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="13.299" height="13.299" viewBox="0 0 13.299 13.299">
						<defs>
							<style>
								.a {
									fill: #486eb8;
								}

								.b {
									fill: #c1484a;
								}
							</style>
						</defs>
						<path class="a" d="M300.014,398.566v-8.542h8.543v.138q0,3.717,0,7.434a.945.945,0,0,1-.966.969q-3.717,0-7.434,0Z" transform="translate(-295.258 -385.267)" />
						<path class="b" d="M284.989,378.787v-2.162c0-.218,0-.435,0-.653a.945.945,0,0,1,.975-.974q3.806,0,7.612,0H297.3a.949.949,0,0,1,.986.979q0,1.35,0,2.7v.111Z" transform="translate(-284.989 -374.996)" />
						<path class="a" d="M284.99,390.019h3.792v8.543H285.99a.953.953,0,0,1-1-1.009q0-3.665,0-7.329Z" transform="translate(-284.99 -385.263)" />
					</svg>
					<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="14.8" height="14.8" viewBox="0 0 14.8 14.8">
						<defs>
							<style>
								.a {
									fill: #486eb8;
								}

								.b {
									fill: #c1484a;
								}
							</style>
						</defs>
						<g transform="translate(-326.632 -393.762)">
							<path class="a" d="M340.09,393.762h-9.421a1.341,1.341,0,0,0-1.345,1.337v9.43a1.344,1.344,0,0,0,1.344,1.346h9.423a1.344,1.344,0,0,0,1.341-1.346v-9.421A1.345,1.345,0,0,0,340.09,393.762Zm-8.075,9.421v-1.346h4.71v1.346Zm6.729-2.692h-6.729v-1.346h6.729Zm0-2.692h-6.729v-1.345h6.729Z" />
							<path class="b" d="M327.978,396.454V407.22h10.766v1.342H327.978a1.345,1.345,0,0,1-1.346-1.342V396.454Z" />
						</g>
					</svg>
					<span>Tests</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="16.004" height="16.004" viewBox="0 0 16.004 16.004">
						<defs>
							<style>
								.a {
									fill: #486eb8;
								}

								.b {
									fill: #c1484a;
								}
							</style>
						</defs>
						<g transform="translate(0 0)">
							<path class="a" d="M272.049,370.9v-1.688a.581.581,0,0,1,.653-.409c.265.016.531,0,.8.005.113,0,.153-.032.188-.145.13-.432.259-.866.429-1.283.137-.335.332-.645.51-.983-.229-.228-.469-.465-.706-.7a.515.515,0,0,1,0-.817q.462-.466.927-.928a.526.526,0,0,1,.861,0l.689.69a.342.342,0,0,0,.059-.021,6.407,6.407,0,0,1,2.246-.935c.09-.018.1-.072.1-.146,0-.276.012-.552,0-.828a.582.582,0,0,1,.409-.653H280.9a.581.581,0,0,1,.409.653c-.015.265,0,.531-.005.8,0,.112.029.154.144.189.442.133.886.266,1.313.439a10.633,10.633,0,0,1,.953.5c.229-.229.466-.469.706-.707a.516.516,0,0,1,.817,0q.466.462.929.927a.528.528,0,0,1,0,.862l-.69.693a.282.282,0,0,0,.019.054,6.423,6.423,0,0,1,.936,2.246c.018.088.069.1.145.1.276,0,.553.012.828,0a.581.581,0,0,1,.653.409V370.9a.58.58,0,0,1-.653.409c-.265-.016-.531,0-.8-.005-.113,0-.153.032-.188.145-.134.441-.267.886-.441,1.312a10.594,10.594,0,0,1-.5.953c.223.222.455.452.686.684a.528.528,0,0,1,0,.862q-.452.453-.906.905a.528.528,0,0,1-.862,0l-.692-.69a.3.3,0,0,0-.055.019,6.437,6.437,0,0,1-2.246.936c-.089.018-.1.07-.1.145,0,.276-.012.552,0,.828a.58.58,0,0,1-.409.652h-1.688a.581.581,0,0,1-.409-.653c.016-.264,0-.531.005-.8,0-.112-.026-.161-.145-.187a6.261,6.261,0,0,1-1.881-.73c-.121-.071-.24-.144-.37-.223l-.7.7a.528.528,0,0,1-.862,0l-.905-.906a.527.527,0,0,1,0-.861l.69-.69a.329.329,0,0,0-.021-.058,6.4,6.4,0,0,1-.935-2.246c-.018-.09-.071-.1-.146-.1-.276,0-.552-.011-.828,0A.581.581,0,0,1,272.049,370.9Zm8-6.04a5.2,5.2,0,1,0,5.2,5.19A5.19,5.19,0,0,0,280.049,364.855Z" transform="translate(-272.049 -362.049)" />
							<path class="b" d="M288.017,379.318l3.528,2.4-3.522,2.4v-1.429h-2.739c.083-.343.139-.66.24-.962s.246-.572.369-.858a.178.178,0,0,1,.194-.113c.589,0,1.177,0,1.766,0,.131,0,.168-.038.166-.167C288.013,380.181,288.017,379.77,288.017,379.318Z" transform="translate(-282.165 -375.248)" />
							<path class="b" d="M300.431,395.007l3.528-2.4v1.429h2.635c-.029.172-.047.324-.082.471a5.005,5.005,0,0,1-.521,1.331.216.216,0,0,1-.217.129c-.547-.006-1.094,0-1.64-.006-.135,0-.182.034-.179.175.009.41,0,.821,0,1.268Z" transform="translate(-293.742 -385.405)" />
						</g>
					</svg>
					<span>Doctors</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-down pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu" style="display: none;">
					<li><a href=""><i class="fa fa-circle-o"></i>List</a></li>
					<li><a href=""><i class="fa fa-circle-o"></i>Add Doctors</a></li>
				</ul>
			</li>
			<li>
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="15.28" height="13.753" viewBox="0 0 15.28 13.753">
						<defs>
							<style>
								.a {
									fill: #486eb8;
								}

								.b {
									fill: #c1484a;
								}
							</style>
						</defs>
						<g transform="translate(0 0)">
							<path class="a" d="M284.617,404.991q3.424,0,6.849,0a.735.735,0,0,1,.788.783c-.017.211-.045.422-.068.633q-.139,1.273-.278,2.546c-.074.68-.145,1.36-.226,2.04a.73.73,0,0,1-.759.613q-1.513,0-3.026,0h-9.509a1.29,1.29,0,0,1-.284-.027.707.707,0,0,1-.559-.634q-.25-2.277-.5-4.554-.032-.293-.064-.585a.732.732,0,0,1,.756-.813q1.728,0,3.456,0Zm2.356,3.55H282.26c.035-.125.07-.24.1-.357a.517.517,0,0,0-.989-.3c-.111.348-.218.7-.313,1.051a.511.511,0,0,0,.493.647c.074,0,.149,0,.223,0h5.862a.511.511,0,0,0,.545-.617c-.094-.374-.21-.745-.335-1.11a.5.5,0,0,0-.636-.3.508.508,0,0,0-.34.617C286.9,408.287,286.934,408.4,286.973,408.541Z" transform="translate(-276.976 -397.853)" />
							<path class="a" d="M294.116,384.5c-.313,0-.6,0-.9,0-.108,0-.115-.068-.138-.136l-.911-2.729c-.178-.533-.359-1.065-.531-1.6a.158.158,0,0,0-.18-.128q-3.941,0-7.883,0c-.144,0-.176.07-.211.177-.467,1.408-.939,2.814-1.4,4.224-.05.154-.116.2-.276.195-.253-.015-.509,0-.783,0,.019-.077.032-.142.051-.205l1.883-6.121c.079-.257.122-.288.4-.288h8.584c.222,0,.282.041.346.249q.962,3.12,1.922,6.241C294.1,384.412,294.1,384.449,294.116,384.5Z" transform="translate(-279.87 -377.888)" />
							<path class="b" d="M297.768,400.178h-9.145c.087-.322.166-.634.26-.942.01-.032.1-.056.157-.056q1.441-.005,2.883,0,2.7,0,5.4,0c.132,0,.2.031.227.169C297.61,399.621,297.692,399.893,297.768,400.178Z" transform="translate(-285.556 -393.569)" />
							<path class="b" d="M298.247,393.376l.271,1h-8.312c.088-.32.171-.636.266-.947.009-.028.1-.046.148-.046q1.346,0,2.692,0h4.935Z" transform="translate(-286.723 -389.297)" />
							<path class="b" d="M299,387.587l.269.992H291.8l.268-.992Z" transform="translate(-287.892 -385.033)" />
						</g>
					</svg>
					<span>Track</span>
				</a>
			</li>
			<li>
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="12.953" height="14.805" viewBox="0 0 12.953 14.805">
						<defs>
							<style>
								.a {
									fill: #c1484a;
								}

								.b {
									fill: #486eb8;
								}
							</style>
						</defs>
						<g transform="translate(-273.621 -393.372)">
							<path class="a" d="M273.621,395.8v-.81a.692.692,0,0,1,.69-.694h3.242l.272-.541a.686.686,0,0,1,.619-.385h3.3a.693.693,0,0,1,.621.385l.272.541h3.238a.692.692,0,0,1,.694.69v.814a.348.348,0,0,1-.347.347h-12.26A.348.348,0,0,1,273.621,395.8Z" />
							<path class="b" d="M285.3,397.074H274.893a.348.348,0,0,0-.347.347v9.368a1.387,1.387,0,0,0,1.388,1.388h8.327a1.388,1.388,0,0,0,1.388-1.388v-9.368h0A.349.349,0,0,0,285.3,397.074Zm-7.517,8.785a.463.463,0,0,1-.925,0v-6.472a.463.463,0,0,1,.925,0Zm2.776,0a.463.463,0,0,1-.925,0v-6.472a.463.463,0,0,1,.925,0Zm2.776,0a.463.463,0,0,1-.925,0v-6.472a.463.463,0,0,1,.925,0Z" />
						</g>
					</svg>
					<span>Messages</span>
				</a>
			</li>
		</ul>

		<ul class="sidebar-menu secound-menu" data-widget="tree">
			<!-- <li class="header">NAVIGATION</li> -->
			<!-- Optionally, you can add icons to the links -->
			<li class="treeview">
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="22.772" height="24.087" viewBox="0 0 22.772 24.087">
						<defs>
							<style>
								.a {
									fill: #333;
								}
							</style>
						</defs>
						<g transform="translate(0)">
							<path class="a" d="M271.153,395.4c0,.713,0,1.4,0,2.085a1.092,1.092,0,0,0,1.216,1.211h6.721a1.09,1.09,0,0,0,1.2-1.2q0-1.031,0-2.062a.6.6,0,0,1,.02-.087H284.1c.4,0,.523.116.523.516,0,1.609,0,3.219.005,4.828,0,.227-.043.315-.3.34a5.234,5.234,0,0,0-1.882,9.761.262.262,0,0,1,.146.268q-.008,1.771,0,3.542a5.5,5.5,0,0,0,.034.919,6.591,6.591,0,0,0,.283.89c-.052,0-.119.016-.186.016q-7.74,0-15.48,0c-.388,0-.5-.119-.5-.509q0-10.019,0-20.039c0-.364.119-.488.471-.489q1.856,0,3.712,0C270.992,395.386,271.056,395.392,271.153,395.4Zm4.862,15.909h2.741c.251,0,.5.006.752,0a.359.359,0,0,0,.378-.36.379.379,0,0,0-.358-.386,2.212,2.212,0,0,0-.242-.006h-6.475a2.819,2.819,0,0,0-.315.007.33.33,0,0,0-.322.356.357.357,0,0,0,.3.381,1.05,1.05,0,0,0,.242.01Zm.232-8.135h3.494a1.322,1.322,0,0,0,.242-.01.37.37,0,0,0,0-.729,1,1,0,0,0-.218-.007H272.66a.8.8,0,0,0-.193.008.351.351,0,0,0-.295.363.338.338,0,0,0,.291.361,1.3,1.3,0,0,0,.266.014Zm-.571,10.089h0c-1.027,0-2.054,0-3.08,0a.374.374,0,0,0-.424.391c.006.22.164.36.426.366.234,0,.469,0,.7,0h5.457a.423.423,0,0,0,.446-.386c.008-.211-.175-.371-.448-.371C277.729,413.258,276.7,413.26,275.676,413.26Zm-.573-7.381h2.472c.325,0,.49-.122.494-.364s-.164-.379-.48-.38q-2.472,0-4.945,0c-.291,0-.468.141-.473.37s.159.372.459.373C273.455,405.88,274.279,405.879,275.1,405.879Zm.041,2.712c.824,0,1.648,0,2.472,0,.3,0,.457-.14.452-.381s-.159-.363-.447-.363q-2.484,0-4.969,0c-.308,0-.484.146-.48.386s.167.359.475.359Zm-5.459,5.424v0c.1,0,.193,0,.29,0a.347.347,0,0,0,.377-.351.353.353,0,0,0-.334-.4,4.762,4.762,0,0,0-.7,0,.374.374,0,0,0,.005.746A2.954,2.954,0,0,0,269.685,414.015Zm0-11.63v0c-.113,0-.226-.007-.338,0a.371.371,0,0,0-.372.39.362.362,0,0,0,.375.362c.216.011.434.01.651,0a.335.335,0,0,0,.354-.348.367.367,0,0,0-.332-.4A2.783,2.783,0,0,0,269.682,402.385Zm0,8.919v0c.1,0,.193,0,.29,0a.342.342,0,0,0,.381-.345.355.355,0,0,0-.356-.4,6.093,6.093,0,0,0-.676,0,.331.331,0,0,0-.347.354.364.364,0,0,0,.346.39C269.437,411.313,269.559,411.3,269.679,411.3Zm0-2.714h0c.1,0,.21,0,.315,0a.33.33,0,0,0,.357-.342.349.349,0,0,0-.336-.395,6.214,6.214,0,0,0-.7,0,.349.349,0,0,0-.341.368.361.361,0,0,0,.343.368C269.434,408.6,269.556,408.59,269.678,408.59Zm-.012-3.452h0c-.1,0-.21,0-.315,0a.359.359,0,0,0-.38.378.354.354,0,0,0,.372.361c.217.008.435.008.653,0a.344.344,0,0,0,.354-.351.359.359,0,0,0-.346-.387C269.893,405.13,269.779,405.138,269.666,405.138Z" transform="translate(-266.745 -392.714)" />
							<path class="a" d="M284.416,393.469q-1.674,0-3.348,0c-.394,0-.521-.128-.522-.523q0-1.115,0-2.231c0-.359.117-.472.483-.474.283,0,.566-.007.849,0,.142,0,.207-.028.243-.187a2.366,2.366,0,0,1,2.312-1.848,2.337,2.337,0,0,1,2.285,1.843c.034.15.091.2.241.193.3-.01.6-.006.9,0s.437.125.439.422q.008,1.188,0,2.377c0,.307-.135.427-.458.428Q286.127,393.472,284.416,393.469Zm1.559-3.276a1.577,1.577,0,0,0-1.622-1.271,1.541,1.541,0,0,0-1.476,1.271Z" transform="translate(-275.461 -388.208)" />
							<path class="a" d="M313.068,417.233a4.517,4.517,0,1,1-4.548-4.511A4.533,4.533,0,0,1,313.068,417.233Zm-.711.007a3.829,3.829,0,0,0-3.809-3.84,3.8,3.8,0,1,0,3.809,3.84Z" transform="translate(-290.297 -403.69)" />
							<path class="a" d="M311.817,438.492a5.472,5.472,0,0,0,3.289-.006c0,.255,0,.48,0,.7,0,1.091.02,2.181-.008,3.27a1.639,1.639,0,0,1-2.358,1.421,1.545,1.545,0,0,1-.935-1.4c-.026-1.3-.008-2.6-.008-3.9A.508.508,0,0,1,311.817,438.492Z" transform="translate(-295.195 -419.963)" />
						</g>
					</svg>
					<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="22.321" height="26.639" viewBox="0 0 22.321 26.639">
						<defs>
							<style>
								.a {
									fill: #333;
									fill-rule: evenodd;
								}
							</style>
						</defs>
						<path class="a" d="M0,26.64a8.364,8.364,0,0,1,8.349-8.352h5.6a8.417,8.417,0,0,1,8.373,8.352ZM11.148,5.09a5.787,5.787,0,0,1,4.187,9.789h-2.02a1.8,1.8,0,0,0-1.168-.414h-2a1.9,1.9,0,0,0-1.826,1.485A5.8,5.8,0,0,1,11.148,5.09Zm8.641,6.234c0,.024-.024.024-.049.049a2.72,2.72,0,0,1-.779,1.583l-.073.073V15.05a2.908,2.908,0,0,1-.1.706,1.608,1.608,0,0,1-.292.536,1.3,1.3,0,0,1-.487.317,1.422,1.422,0,0,1-.462.1h-4.7a.839.839,0,0,1-.706.414h-2a.806.806,0,0,1-.8-.779.784.784,0,0,1,.779-.779h2a.809.809,0,0,1,.706.414h4.5a1.234,1.234,0,0,0,.316-.049.53.53,0,0,0,.195-.122.685.685,0,0,0,.122-.268,2.455,2.455,0,0,0,.049-.463V13.54a2.138,2.138,0,0,1-.365.122.914.914,0,0,0,.024-.268v-4.7a1.187,1.187,0,0,0-.024-.292,2.936,2.936,0,0,1,1.193.706c.024.024.073.049.1.1V9.011a8.352,8.352,0,0,0-.122-1.364,12.05,12.05,0,0,0-.365-1.339,9.7,9.7,0,0,0-.584-1.242,7.091,7.091,0,0,0-.779-1.12c-.024-.024-.024-.073-.049-.1a.691.691,0,0,1-.584-.195,7.579,7.579,0,0,0-10.71,0,.719.719,0,0,1-.584.195.185.185,0,0,1-.049.1,7.087,7.087,0,0,0-.779,1.12,5.789,5.789,0,0,0-.584,1.242,5.826,5.826,0,0,0-.365,1.315,8.352,8.352,0,0,0-.122,1.364v.195l.1-.1a2.6,2.6,0,0,1,1.193-.706,1.186,1.186,0,0,0-.024.292v4.724a1.093,1.093,0,0,0,.024.268,2.937,2.937,0,0,1-1.193-.706,2.721,2.721,0,0,1-.779-1.583c0-.024-.024-.024-.049-.049a.4.4,0,0,1-.122-.292V9.011A7.741,7.741,0,0,1,2.532,7.5a7.849,7.849,0,0,1,.389-1.485,12.123,12.123,0,0,1,.657-1.388,7.177,7.177,0,0,1,.876-1.242.428.428,0,0,1,.122-.1.742.742,0,0,1,.195-.657A9.031,9.031,0,0,1,11.148,0,8.934,8.934,0,0,1,17.5,2.631a.742.742,0,0,1,.195.657.243.243,0,0,1,.122.1,7.173,7.173,0,0,1,.876,1.242,7.244,7.244,0,0,1,.657,1.388c.17.487.292.974.438,1.485a10.249,10.249,0,0,1,.122,1.51v2.021A.45.45,0,0,1,19.79,11.324Z" transform="translate(0 -0.001)" />
					</svg>
					<span>Tests</span>
				</a>
			</li>
			<li>
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="27.057" height="21.603" viewBox="0 0 27.057 21.603">
						<defs>
							<style>
								.a {
									fill: #333;
								}
							</style>
						</defs>
						<g transform="translate(0 0)">
							<path class="a" d="M282.587,395.559l-.621,2.153c-.479-.271-.926-.554-1.4-.785a11.825,11.825,0,0,0-6.216-1.146,11.084,11.084,0,0,0-5.488,1.844,7.1,7.1,0,0,0-3.084,4.066,6.036,6.036,0,0,0,1.707,5.991,9.486,9.486,0,0,0,2.357,1.748.331.331,0,0,1,.188.41,9.933,9.933,0,0,1-.924,2.893c-.019.039-.031.083-.062.168.157-.04.282-.068.406-.1a7.349,7.349,0,0,0,3.537-2.08.5.5,0,0,1,.514-.13,12.265,12.265,0,0,0,2.72.109,12.885,12.885,0,0,0,2.7-.5c.076-.023.153-.041.266-.072.066.4.129.775.19,1.154.043.267.082.534.127.8a.2.2,0,0,1-.171.272,14.27,14.27,0,0,1-5.1.51.681.681,0,0,0-.53.181,10,10,0,0,1-4.549,2.063,1.9,1.9,0,0,1-1.946-.795,2.014,2.014,0,0,1-.238-2.187c.189-.418.367-.84.563-1.255.085-.182.041-.282-.121-.4a9.52,9.52,0,0,1-3.06-3.441,7.887,7.887,0,0,1,.571-8.532,10.884,10.884,0,0,1,5.916-4.224,14.039,14.039,0,0,1,11.242.989C282.245,395.352,282.405,395.453,282.587,395.559Z" transform="translate(-263.362 -393.54)" />
							<path class="a" d="M307.1,409.636c.119-.441.231-.884.358-1.323,1.141-3.96,2.292-7.918,3.417-11.882a1.339,1.339,0,0,1,1.738-.947c1.039.325,2.09.611,3.136.913a1.285,1.285,0,0,1,.957,1.746q-1.244,4.305-2.484,8.612c-.382,1.323-.776,2.642-1.143,3.969a3.234,3.234,0,0,1-.787,1.241q-1.347,1.552-2.7,3.1a2.536,2.536,0,0,1-.247.25.819.819,0,0,1-1.378-.418c-.124-.514-.193-1.042-.276-1.566-.177-1.118-.348-2.238-.519-3.357-.016-.106-.022-.215-.032-.322Zm8.268-11.372c.006-.541-.132-.76-.51-.879-.652-.2-1.307-.4-1.968-.574a.726.726,0,0,0-.952.525c-.131.4-.23.814-.356,1.217-.054.174,0,.249.164.292.244.065.485.138.726.208.726.21,1.45.426,2.179.624.1.026.3-.008.312-.058C315.124,399.126,315.26,398.623,315.364,398.264Zm-6.811,12.183a.6.6,0,0,0-.043.137c.052.681.1,1.362.166,2.042.007.069.11.159.188.186.254.089.52.144.774.232a.322.322,0,0,0,.431-.145c.32-.468.657-.925.986-1.387.055-.077.1-.16.181-.288Z" transform="translate(-289.722 -394.668)" />
							<path class="a" d="M294.339,413.133a1.907,1.907,0,0,1,1.892,1.891,1.917,1.917,0,1,1-3.835,0A1.879,1.879,0,0,1,294.339,413.133Z" transform="translate(-280.862 -405.349)" />
							<path class="a" d="M280.243,415.036a1.879,1.879,0,0,1-1.926,1.9,1.913,1.913,0,0,1-1.871-1.886,1.9,1.9,0,1,1,3.8-.018Z" transform="translate(-271.248 -405.348)" />
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="title">
			<h2>Dashboard</h2>
			<span>Your last login: Nov 11, 2020 at 11:32 pm</span>
		</div>
		<div class="heading-btns">
			<button class="btn btn-warning">Document</button>
			<button class="btn btn-link">Templates</button>
			<button class="btn btn-link">Notifications</button>
			<div class="position-relative">
				<button class="btn btn-success addnew-btn"><i class="fas fa-plus"></i> Add New</button>
				<div class="addnew-dropdown">
					<div class="addnew-body">
						<h5>Upload or Create</h5>
						<div class="shareable-links">
							<ul>
								<li>
									<a href="#">
										<div class="link-img"><img src="{{ asset('public/front/images/upload.svg') }}"></div>
										<span>Upload Document</span>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="link-img"><img src="{{ asset('public/front/images/upload-template.svg') }}"></div>
										<span>Upload Template</span>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="link-img"><img src="{{ asset('public/front/images/create-document.svg') }}"></div>
										<span>Create Document</span>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="link-img"><img src="{{ asset('public/front/images/new-folder.svg') }}"></div>
										<span>New Folder</span>
									</a>
								</li>
							</ul>
						</div>
						<h5>Search Our Libraries</h5>
						<div class="searchwith-legalform">
							<div class="input-group input-group-joined input-group-solid ml-3">
								<input class="form-control mr-sm-0" type="search" placeholder="Search" aria-label="Search">
								<div class="input-group-append">
									<button class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
											<circle cx="11" cy="11" r="8"></circle>
											<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
										</svg></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>



			<div class="input-group input-group-joined input-group-solid ml-3">
				<input class="form-control mr-sm-0" type="search" placeholder="Search" aria-label="Search">
				<div class="input-group-append">
					<button class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg></button>
				</div>
			</div>
		</div>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="recent-documents">
			<h4>Recent Documents</h4>
		</div>

		<div class="single-document">
			<div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image"></div>
			<div class="doc-content">
				<h5>PDFwriter How To Guide</h5>
				<div class="last-activity">Last activity: <strong>You opened PDFwriter How To Guide.pdf</strong></div>
				<dtv class="tags">
					<span class="tag badge badge-warning">GuideBook</span>
					<a href="" class="add-tag">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
							<g>
								<g>
									<path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
								</g>
							</g>
							<g>
								<g>
									<path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
								</g>
							</g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
						</svg> Add tag
					</a>
				</dtv>
			</div>
			<div class="doc-date-and-dismiss">
				<div class="doc-date"><i class="fas fa-calendar-day"></i> Nov 11, 2020 at 11:32 pm</div>
				<button><i class="fas fa-ellipsis-v"></i></button>
			</div>
		</div>

		<div class="single-document free-trial-document">
			<div class="doc-img">
				<h4><strong>Free</strong> Trial</h4>
			</div>
			<div class="doc-content">
				<h5>Get PDFwriter For FREE. Fill and edit documents Signed.pdf</h5>
				<dtv class="tags">
					<ul>
						<li>Print</li>
						<li>-</li>
						<li>Save as</li>
						<li>-</li>
						<li>Email</li>
						<li>-</li>
						<li>E-Sign</li>
						<li>-</li>
						<li>Fax</li>
						<li>-</li>
						<li>Share</li>
					</ul>
				</dtv>
			</div>
			<div class="doc-date-and-dismiss">
				<div class="start-days-trial">Start 30 Days Free Trial</div>
				<button><i class="fas fa-times"></i></button>
			</div>
		</div>

		<div class="single-document">
			<div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image"></div>
			<div class="doc-content">
				<h5>PDFwriter How To Guide</h5>
				<div class="last-activity">Last activity: <strong>You opened PDFwriter How To Guide.pdf</strong></div>
				<dtv class="tags">
					<span class="tag badge badge-warning">GuideBook</span>
					<span class="tag badge badge-primary">GuideBook</span>
					<a href="" class="add-tag">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
							<g>
								<g>
									<path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
								</g>
							</g>
							<g>
								<g>
									<path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
								</g>
							</g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
						</svg> Add tag
					</a>
				</dtv>
			</div>
			<div class="doc-date-and-dismiss">
				<div class="doc-date"><i class="fas fa-calendar-day"></i> Nov 11, 2020 at 11:32 pm</div>
				<button><i class="fas fa-ellipsis-v"></i></button>
			</div>
		</div>

		<div class="single-document">
			<div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image"></div>
			<div class="doc-content">
				<h5>PDFwriter How To Guide</h5>
				<div class="last-activity">Last activity: <strong>You opened PDFwriter How To Guide.pdf</strong></div>
				<dtv class="tags">
					<span class="tag badge badge-warning">GuideBook</span>
					<span class="tag badge badge-primary">GuideBook</span>
					<a href="" class="add-tag">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
							<g>
								<g>
									<path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
								</g>
							</g>
							<g>
								<g>
									<path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
								</g>
							</g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
						</svg> Add tag
					</a>
				</dtv>
			</div>
			<div class="doc-date-and-dismiss">
				<div class="doc-date"><i class="fas fa-calendar-day"></i> Nov 11, 2020 at 11:32 pm</div>
				<button><i class="fas fa-ellipsis-v"></i></button>
			</div>
		</div>

		<div class="single-document">
			<div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image"></div>
			<div class="doc-content">
				<h5>PDFwriter How To Guide</h5>
				<div class="last-activity">Last activity: <strong>You opened PDFwriter How To Guide.pdf</strong></div>
				<dtv class="tags">
					<span class="tag badge badge-warning">GuideBook</span>
					<span class="tag badge badge-primary">GuideBook</span>
					<a href="" class="add-tag">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
							<g>
								<g>
									<path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
								</g>
							</g>
							<g>
								<g>
									<path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
								</g>
							</g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
						</svg> Add tag
					</a>
				</dtv>
			</div>
			<div class="doc-date-and-dismiss">
				<div class="doc-date"><i class="fas fa-calendar-day"></i> Nov 11, 2020 at 11:32 pm</div>
				<button><i class="fas fa-ellipsis-v"></i></button>
			</div>
		</div>


		<div class="single-document">
			<div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image"></div>
			<div class="doc-content">
				<h5>PDFwriter How To Guide</h5>
				<div class="last-activity">Last activity: <strong>You opened PDFwriter How To Guide.pdf</strong></div>
				<dtv class="tags">
					<span class="tag badge badge-warning">GuideBook</span>
					<span class="tag badge badge-primary">GuideBook</span>
					<a href="" class="add-tag">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
							<g>
								<g>
									<path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
								</g>
							</g>
							<g>
								<g>
									<path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
								</g>
							</g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
						</svg> Add tag
					</a>
				</dtv>
			</div>
			<div class="doc-date-and-dismiss">
				<div class="doc-date"><i class="fas fa-calendar-day"></i> Nov 11, 2020 at 11:32 pm</div>
				<button><i class="fas fa-ellipsis-v"></i></button>
			</div>
		</div>


		<div class="single-document">
			<div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image"></div>
			<div class="doc-content">
				<h5>PDFwriter How To Guide</h5>
				<div class="last-activity">Last activity: <strong>You opened PDFwriter How To Guide.pdf</strong></div>
				<dtv class="tags">
					<span class="tag badge badge-warning">GuideBook</span>
					<span class="tag badge badge-primary">GuideBook</span>
					<a href="" class="add-tag">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
							<g>
								<g>
									<path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341 c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z " />
								</g>
							</g>
							<g>
								<g>
									<path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318 c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83 s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z" />
								</g>
							</g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
							<g> </g>
						</svg> Add tag
					</a>
				</dtv>
			</div>
			<div class="doc-date-and-dismiss">
				<div class="doc-date"><i class="fas fa-calendar-day"></i> Nov 11, 2020 at 11:32 pm</div>
				<button><i class="fas fa-ellipsis-v"></i></button>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection