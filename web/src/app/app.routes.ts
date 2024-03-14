import { Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { authGuard } from './guards/auth.guard';




export const routes: Routes = [
    {path: '', loadComponent: () => import('./components/login/login.component').then(l => l.LoginComponent)},
    {path: 'verificar', loadComponent: () => import('./components/verficar-login/verficar-login.component').then(v => v.VerficarLoginComponent)},
    {path: 'registrar', loadComponent: () => import('./components/register/register.component').then(r => r.RegisterComponent) },
    {path: 'dashboard', loadComponent: () => import('./components/dashboard/dashboard.component').then(d => d.DashboardComponent), canActivate: [authGuard]},
    {path: 'ver-misiones', loadComponent: () => import('./components/view-misiones/view-misiones.component').then(vm => vm.ViewMisionesComponent),},
    {path: 'ver-jugadores', loadComponent: () => import('./components/view-usuarios/view-usuarios.component').then(vu => vu.ViewUsuariosComponent)},
    {path: 'ver-recompensas', loadComponent: () => import('./components/view-recompensas/view-recompensas.component').then(vr => vr.ViewRecompensasComponent)},
    {path: 'form-misiones', loadComponent: () => import('./components/nuevo-formulario-mision/nuevo-formulario-mision.component').then(fm => fm.NuevoFormularioMisionComponent)},
    {path: ' form-armas', loadComponent: () => import('./components/form-armas/form-armas.component').then(fa => fa.FormArmasComponent)},
    {path: 'form-heroes', loadComponent: () => import('./components/form-heroes/form-heroes.component').then(fh => fh.FormHeroesComponent)},
    {path: 'form-inventario', loadComponent: () => import('./components/form-inventario/form-inventario.component').then(fi => fi.FormInventarioComponent)},
    {path: 'form-recompensas', loadComponent: () => import('./components/form-recompensas/form-recompensas.component').then(fr => fr.FormRecompensasComponent)},
    {path: 'form-clanes', loadComponent: () => import('./components/form-clanes/form-clanes.component').then(fc => fc.FormClanesComponent)}
];