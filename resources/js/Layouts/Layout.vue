<template>
  <div>
    <header>
      <nav>
        <div class="space-x-6">
          <Link
            class="nav-link"
            :href="route('home')"
            :class="{ 'bg-slate-700': $page.component === 'Home' }"
            >Home</Link
          >
        </div>

        <div v-if="$page.props.auth.user" class="space-x-6">
          <Link
            class="nav-link"
            :href="route('transfer')"
            :class="{ 'bg-slate-700': $page.component === 'Transfer' }"
            >Transfer</Link
          >
          <Link
            class="nav-link"
            :href="route('dashboard')"
            :class="{ 'bg-slate-700': $page.component === 'Dashboard' }"
            >Dashboard</Link
          >
          <Link
            class="nav-link"
            :href="route('logout')"
            method="post"
            as="button"
            type="button"
            >Logout</Link
          >
        </div>

        <div v-else="" class="space-x-6">
          <Link
            class="nav-link"
            :href="route('register')"
            :class="{ 'bg-slate-700': $page.component === 'Auth/Register' }"
            >Register</Link
          >
          <Link
            class="nav-link"
            :href="route('login')"
            :class="{ 'bg-slate-700': $page.component === 'Auth/Login' }"
            >Login</Link
          >
        </div>
      </nav>
    </header>

    <main class="p-4">
      <slot />
    </main>
  </div>
</template>
