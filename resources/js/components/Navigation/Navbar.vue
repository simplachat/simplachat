<template>
    <div>
        <!-- Mobile menu -->
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="relative z-40 lg:hidden" @close="open = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
                            <div class="flex px-4 pb-2 pt-5">
                                <button type="button" class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-900" @click="open = false">
                                    <span class="sr-only">Close menu</span>
                                    <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
                                </button>
                            </div>

                            <!-- Links -->
                            <TabGroup as="div" class="mt-2">
                                <div class="border-b border-gray-200">
                                    <TabList class="-mb-px flex space-x-8 px-4">
                                        <Tab as="template" v-for="category in navigation.categories" :key="category.name" v-slot="{ selected }">
                                            <button :class="[selected ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-900', 'flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium']">
                                                {{ category.name }}
                                            </button>
                                        </Tab>
                                    </TabList>
                                </div>
                                <TabPanels as="template">
                                    <TabPanel v-for="(category, categoryIdx) in navigation.categories" :key="category.name" class="space-y-12 px-4 pb-6 pt-10">
                                        <div class="grid grid-cols-1 items-start gap-x-6 gap-y-12">
                                            <div class="grid grid-cols-1 gap-x-6 gap-y-12">
                                                <div>
                                                    <p :id="`mobile-featured-heading-${categoryIdx}`" class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                                                        Accès rapide
                                                    </p>
                                                    <ul role="list" :aria-labelledby="`mobile-featured-heading-${categoryIdx}`" class="mt-4 space-y-6">
                                                        <li v-for="item in category.collections" :key="item.name" class="flex">
                                                            <a :href="item.href" class="group relative flex items-center gap-x-4 w-full">
                                                                <component :is="item.icon" class="h-5 w-5 text-gray-900 stroke-2" aria-hidden="true"/>
                                                                {{ item.name }}
                                                                <!-- Heroicon name: chevron-left -->
                                                                <ArrowSmallRightIcon class="ml-auto h-5 w-5 text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-300 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div>
                                                    <p id="mobile-categories-heading" class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                                                        Catégories
                                                    </p>
                                                    <ul role="list" aria-labelledby="mobile-categories-heading" class="mt-6 space-y-6">
                                                        <li v-for="item in category.categories" :key="item.name" class="flex">
                                                            <a :href="item.href" class="group relative flex items-center w-full">
                                                                {{item.name }}
                                                                <!-- Heroicon name: chevron-left -->
                                                                <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </TabPanel>
                                </TabPanels>
                            </TabGroup>

                            <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                                <div v-for="page in navigation.pages" :key="page.name" class="flow-root">
                                    <a :href="page.href" class="-m-2 p-2 font-medium text-gray-900 group relative flex items-center gap-x-1">
                                        {{ page.name }}
                                        <!-- Heroicon name: chevron-left -->
                                        <ArrowSmallRightIcon class="h-5 w-5 text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-300 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                    </a>
                                </div>
                            </div>

                            <div class="space-y-6 border-t border-gray-200 px-4 py-6">
                                <div class="flow-root">
                                    <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Create an account</a>
                                </div>
                                <div class="flow-root">
                                    <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Sign in</a>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <header class="relative">
            <nav aria-label="Top">
                <!-- Top navigation -->
                <!--<div class="relative isolate flex items-center gap-x-6 overflow-hidden bg-gray-900 px-6 py-2.5 sm:px-3.5 sm:before:flex-1">
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                        <p class="text-sm leading-6 text-white">
                            <strong class="font-semibold">GenericCon 2023</strong>
                            <svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true">
                                <circle cx="1" cy="1" r="1" />
                            </svg>
                            Join us in Denver from June 7 – 9 to see what’s coming next.
                        </p>
                        <a href="#" class="flex-none rounded-full bg-white px-3.5 py-1 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">
                            Register now
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                    <div class="flex flex-1 justify-end">
                        <button type="button" class="-m-3 p-3 focus-visible:outline-offset-[-4px]">
                            <span class="sr-only">Dismiss</span>
                            <XMarkIcon class="h-5 w-5 stroke-2 text-white" aria-hidden="true"/>
                        </button>
                    </div>
                </div>-->

                <!-- Secondary navigation -->
                <div class="relative">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div>
                            <div class="flex h-24 items-center justify-between">
                                <!-- Logo (lg+) -->
                                <div class="hidden lg:flex lg:items-center">
                                    <a href="/">
                                        <span class="sr-only">Simpl'Achat</span>
                                        <ApplicationLogo class="h-7 w-auto" />
                                    </a>
                                </div>

                                <!-- Mobile menu and search (lg-) -->
                                <div class="flex items-center lg:hidden">
                                    <button type="button" class="rounded-md bg-white px-4 text-gray-900" @click="open = true">
                                        <span class="sr-only">Ouvrir Menu</span>
                                        <Bars3Icon class="h-7 w-7" aria-hidden="true"/>
                                    </button>
                                </div>

                                <!-- Logo (lg-) -->
                                <a href="#" class="flex items-center lg:hidden">
                                    <span class="sr-only">Simpl'Achat</span>
                                    <ApplicationLogo class="h-7 w-auto" />
                                </a>

                                <div class="flex w-full flex-1 items-center justify-end">
                                    <div class="flex w-full items-center justify-end sm:ml-4">
                                        <div class="flex w-full justify-end space-x-4">
                                            <!--<div class="flex w-full max-w-[400px] justify-end">
                                                <TransitionRoot appear :show="!isOpen" as="template" class="w-fit" enter="duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="duration-0" leave-from="opacity-0">
                                                    <button @click="openSearch" type="button" class="p-2 text-gray-900">
                                                        <span class="sr-only">Search</span>
                                                        <MagnifyingGlassIcon class="h-6 w-6" aria-hidden="true"/>
                                                    </button>
                                                </TransitionRoot>
                                                <TransitionRoot appear :show="isOpen" as="template" class="w-full" enter="duration-500 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="opacity-0">
                                                    <form role="search" id="search-form" class="w-full">
                                                        <div class="relative flex w-full items-center">
                                                            <MagnifyingGlassIcon class="h-5 w-5 text-gray-900 absolute left-3 stroke-2"/>
                                                            <input type="text" id="search-bar" name="search" class="w-full rounded-xl border-0 px-10 text-lg leading-none text-gray-950 ring-1 ring-gray-300 transition duration-200 hover:ring-gray-400 focus:border-transparent focus:outline-none focus:ring-gray-600" placeholder="Que recherchez-vous ?" :value="query" required/>
                                                            <button class="absolute right-3" type="button" @click="closeSearch">
                                                                <XMarkIcon class="h-5 w-5 text-gray-500 hover:text-gray-900 stroke-2"/>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </TransitionRoot>
                                            </div>-->

                                            <div class="hidden lg:flex">
                                                <!-- Mega menus -->
                                                <PopoverGroup>
                                                    <div class="flex h-full justify-center items-center space-x-4">
                                                        <Popover v-for="category in navigation.categories" :key="category.name" class="relative" v-slot="{ open }">
                                                            <div class="relative flex">
                                                                <PopoverButton :class="[open ? 'text-gray-900 bg-gray-50 ring-1' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50 hover:ring-1', 'relative z-10 flex px-4 py-1.5 items-center gap-x-1 text-lg rounded-xl ring-gray-300 font-semibold transition duration-500 ease-out focus:outline-none group']">
                                                                    {{ category.name }}
                                                                    <ChevronDownIcon class="h-5 w-5 flex-none" aria-hidden="true" />
                                                                </PopoverButton>
                                                            </div>

                                                            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-1">
                                                                <PopoverPanel class="absolute -right-4 z-10 mt-4 flex w-screen max-w-max px-4">
                                                                    <div class="w-screen max-w-md flex-auto overflow-hidden rounded-xl bg-white leading-6 shadow-lg ring-1 ring-gray-200">
                                                                        <div class="p-6 flex flex-col gap-6">
                                                                            <div class="w-full flex flex-col gap-2">
                                                                                <span class="font-semibold uppercase text-gray-500 text-sm tracking-wide">Accès rapide</span>
                                                                                <div class="flex flex-col gap-2">
                                                                                    <div v-for="item in category.collections" :key="item.name" class="group relative flex gap-x-4 rounded-lg py-2 px-4 hover:bg-gray-50 hover:ring-1 ring-gray-300">
                                                                                        <div class="flex flex-none justify-center rounded-lg">
                                                                                            <component :is="item.icon" class="h-6 w-6 text-gray-900 stroke-2" aria-hidden="true" />
                                                                                        </div>
                                                                                        <div class="w-full">
                                                                                            <a :href="item.href" class="font-semibold text-gray-900 flex items-center w-full">
                                                                                                {{ item.name }}
                                                                                                <span class="absolute inset-0" />
                                                                                                <!-- Heroicon name: chevron-left -->
                                                                                                <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                                                            </a>
                                                                                            <p class="mt-1 text-sm text-gray-600">{{ item.description }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="w-full flex flex-col gap-2">
                                                                                <span class="font-semibold uppercase text-gray-500 text-sm tracking-wide">Catégories</span>
                                                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                                                    <div v-for="item in category.categories" :key="item.name" class="group relative flex items-center rounded-lg py-2 px-4 hover:bg-gray-50 hover:ring-1 ring-gray-300 transition duration-500">
                                                                                        <a :href="item.href" class="font-semibold text-gray-900 flex items-center w-full">
                                                                                            {{ item.name }}
                                                                                            <span class="absolute inset-0" />
                                                                                            <!-- Heroicon name: chevron-left -->
                                                                                            <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </PopoverPanel>
                                                            </transition>
                                                        </Popover>

                                                        <a v-for="page in navigation.pages" :key="page.name" :href="page.href" :class="[page.active ? 'text-gray-900 bg-gray-50 ring-1' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50 hover:ring-1', 'relative z-10 flex px-4 py-1.5 items-center gap-x-1 text-lg rounded-xl ring-gray-300 font-semibold transition duration-500 ease-out focus:outline-none']">
                                                            {{ page.name }}
                                                        </a>
                                                    </div>
                                                </PopoverGroup>
                                            </div>

                                            <div class="hidden sm:flex">
                                                <Popover class="relative flex h-full" v-slot="{ open }">
                                                    <PopoverButton href="#" class="px-4 py-1.5 h-full relative ring-1 ring-gray-900 text-lg z-10 text-white flex items-center gap-x-2 bg-gray-900 rounded-full font-semibold hover:bg-gray-700 transition duration-150 ease-linear focus:outline-none">
                                                        <span class="sr-only">Account</span>
                                                        <UserIcon class="h-5 w-5 stroke-2" aria-hidden="true"/>
                                                        <span>Mon compte</span>
                                                    </PopoverButton>
                                                    <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 -translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-1">
                                                        <PopoverPanel class="absolute -right-4 mt-4 top-full z-10 flex w-screen max-w-max px-4">
                                                            <div class="w-screen max-w-[250px] flex-auto overflow-hidden rounded-xl bg-white leading-6 shadow-lg ring-1 ring-gray-200 p-3 divide-y divide-gray-200" v-if="$page.props.auth.user">
                                                                <div class="flex gap-y-1">
                                                                    <p class="min-w-full flex-wrap break-words p-2 font-semibold leading-6 text-gray-900">
                                                                        Bonjour, {{ $page.props.auth.user.surname }}
                                                                    </p>
                                                                </div>
                                                                <div class="flex flex-col gap-y-1 py-2">
                                                                    <a v-for="item in navigation.userNavigation" :key="item.name" :href="item.href" class="flex items-center min-w-fit p-2 font-medium leading-6 text-gray-900 hover:bg-gray-50 hover:ring-1 ring-gray-300 rounded-lg group">
                                                                        {{ item.name }}
                                                                        <!-- Heroicon name: chevron-left -->
                                                                        <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                                    </a>
                                                                </div>
                                                                <div class="flex flex-col gap-y-1 pt-2">
                                                                    <a href="#" class="flex items-center p-2 font-medium leading-6 text-gray-900 hover:bg-gray-50 hover:ring-1 ring-gray-300 rounded-lg group">
                                                                        Aide/FAQ
                                                                        <!-- Heroicon name: chevron-left -->
                                                                        <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                                    </a>
                                                                    <Link :href="route('logout')" method="post" as="button" class="flex items-center p-2 font-medium leading-6 text-gray-900 hover:bg-gray-50 hover:ring-1 ring-gray-300 rounded-lg group">
                                                                        Déconnexion
                                                                        <!-- Heroicon name: chevron-left -->
                                                                        <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                                    </Link>
                                                                </div>
                                                            </div>
                                                            <div class="w-screen max-w-[250px] flex-auto overflow-hidden rounded-xl bg-white leading-6 shadow-lg ring-1 ring-gray-200 p-3 divide-y divide-gray-200" v-else>
                                                                <div class="flex flex-col gap-y-1 pb-2">
                                                                    <a href="/register" class="flex px-4 py-2 font-medium leading-6 text-gray-900 hover:bg-gray-50 hover:ring-1 ring-gray-300 rounded-lg group items-center transition duration-500 ease-out">
                                                                        Inscription
                                                                        <!-- Heroicon name: chevron-left -->
                                                                        <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                                    </a>
                                                                    <a href="/login" class="flex px-4 py-2 font-medium leading-6 text-gray-900 hover:bg-gray-50 hover:ring-1 ring-gray-300 rounded-lg group items-center transition duration-500 ease-out">
                                                                        Connexion
                                                                        <!-- Heroicon name: chevron-left -->
                                                                        <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                                    </a>
                                                                </div>
                                                                <div class="flex flex-col gap-y-1 pt-2">
                                                                    <a href="#" class="flex px-4 py-2 font-medium leading-6 text-gray-900 hover:bg-gray-50 hover:ring-1 ring-gray-300 rounded-lg group items-center transition duration-500 ease-out">
                                                                        Aide/FAQ
                                                                        <!-- Heroicon name: chevron-left -->
                                                                        <ArrowSmallRightIcon class="h-5 w-5 ml-auto text-gray-900 stroke-2 opacity-0 group-hover:opacity-100 transition duration-500 transform translate-x-0 group-hover:translate-x-0.5" aria-hidden="true"/>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </PopoverPanel>
                                                    </transition>
                                                </Popover>
                                            </div>
                                        </div>

                                        <span class="mx-4 h-6 w-px bg-gray-300 sm:mx-4" v-if="$page.props.auth.user" aria-hidden="true"/>

                                        <div class="flow-root" v-if="$page.props.auth.user">
                                            <a href="#" class="flex items-center p-2">
                                                <ShoppingCartIcon class="h-6 w-6 flex-shrink-0 text-gray-900" aria-hidden="true"/>
                                                <span class="ml-2 font-semibold text-gray-900">{{ $page.props.cart }}</span>
                                                <span class="sr-only">articles, voir le panier</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>
</template>

<script setup>
import { ref } from "vue";
import {
    Dialog,
    DialogPanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    Bars3Icon,
    MagnifyingGlassIcon,
    ShoppingCartIcon,
    UserIcon,
    XMarkIcon,
    RectangleGroupIcon, MegaphoneIcon, ArrowTrendingDownIcon, CheckBadgeIcon, RocketLaunchIcon
} from "@heroicons/vue/24/outline";
import { ChevronDownIcon, ArrowSmallRightIcon } from '@heroicons/vue/20/solid'
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/components/ApplicationLogo.vue";

const navigation = {
    categories: [
        {
            name: "Produits",
            collections: [
                { name: "Tous les produits", href: "#", icon: RectangleGroupIcon, description: 'Accéder à tous nos produits de nos commerçants' },
                { name: "Nouveautés", href: "#", icon: MegaphoneIcon, description: 'Découvrez nos dernières nouveautés disponibles' },
                { name: "Promotions", href: "#", icon: ArrowTrendingDownIcon, description: 'Profitez de nos promotions du moment' },
                //{ name: "Meilleures ventes", href: "#", icon: CheckBadgeIcon, description : 'Découvrez nos produits les plus vendus'},
            ],
            categories: [
                { name: "Épicerie Fine", href: "#" },
                { name: "Boissons", href: "#" },
                { name: "Hygiène & Beauté", href: "#", icon: RocketLaunchIcon },
                { name: "Entretien & Maison", href: "#", icon: RocketLaunchIcon },
                { name: "Bébé & Enfant", href: "#", icon: RocketLaunchIcon },
                { name: "Animaux", href: "#", icon: RocketLaunchIcon },
            ],
        },
        {
            name: "Boutiques",
            collections: [
                { name: "Toutes les boutiques", href: "#", icon: RectangleGroupIcon, description: 'Accéder à toutes nos boutiques proches de chez vous' },
                { name: "Rejoindre Simpl'Achat", href: "#", icon: RocketLaunchIcon, description: 'Vous êtes commerçant ? Rejoignez-nous !' },
            ],
            categories: [
                { name: "Épicerie Fine", href: "#", icon: CheckBadgeIcon },
                { name: "Boissons", href: "#", icon: RocketLaunchIcon },
                { name: "Hygiène & Beauté", href: "#", icon: RocketLaunchIcon },
                { name: "Entretien & Maison", href: "#", icon: RocketLaunchIcon },
            ],
        },
    ],
    pages: [
        { name: "Actualités", href: "/news", active: route().current('news') },
        { name: "À propos", href: "/a-propos", active: route().current('about') },
    ],
    userNavigation: [
        { name: "Mon compte", href: "/mon-compte" },
        { name: "Mes commandes", href: "#" },
    ],
};

const open = ref(false);
const isOpen = ref(false);

function closeSearch() {
    isOpen.value = false;
}
function openSearch() {
    isOpen.value = true;
}

const search = window.location.search;
const params = new URLSearchParams(search);
const query = params.get("search");
if (query) {
    params.set("search", query);
}
</script>
