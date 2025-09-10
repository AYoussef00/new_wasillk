<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Car, Settings, Home, Calendar, Cog } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'لوحة التحكم',
        href: dashboard(),
        icon: Home,
    },
    {
        title: 'السيارات',
        href: '/dashboard/cars',
        icon: Car,
    },
    {
        title: 'الطلبات',
        href: '/dashboard/bookings',
        icon: Calendar,
    },
    {
        title: 'الإعدادات',
        href: '/dashboard/settings',
        icon: Cog,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'الدعم الفني',
        href: '/contact',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset" side="right" class="border-l border-sidebar-border/50 shadow-lg">
        <SidebarHeader class="border-b border-sidebar-border/50 p-4">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child class="hover:bg-transparent">
                        <Link :href="dashboard()" class="flex items-center gap-3">
                            <AppLogo />
                            <span class="font-bold text-lg text-sidebar-foreground">واصل لك</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="p-2">
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter class="border-t border-sidebar-border/50 p-2">
            <NavFooter :items="footerNavItems" />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
