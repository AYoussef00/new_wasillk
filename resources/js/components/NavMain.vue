<script setup lang="ts">
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
    items: NavItem[];
}>();

const page = usePage();
</script>

<template>
    <SidebarGroup class="px-3 py-2">
        <SidebarGroupLabel class="text-xs font-semibold text-sidebar-foreground/70 mb-3">القائمة الرئيسية</SidebarGroupLabel>
        <SidebarMenu class="space-y-1">
            <SidebarMenuItem v-for="item in items" :key="item.title">
                <SidebarMenuButton
                    as-child
                    :is-active="item.href === page.url"
                    :tooltip="item.title"
                    class="w-full justify-start gap-3 px-3 py-2.5 text-sm font-medium transition-all duration-200 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground rounded-lg group"
                    :class="{
                        'bg-sidebar-accent text-sidebar-accent-foreground shadow-sm': item.href === page.url,
                        'text-sidebar-foreground/80': item.href !== page.url
                    }"
                >
                    <Link :href="item.href" class="flex items-center gap-3 w-full">
                        <component :is="item.icon" class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110" />
                        <span class="truncate">{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
