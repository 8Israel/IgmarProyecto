import { Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { RegisterComponent } from './components/register/register.component';
import { authGuard } from './guards/auth.guard';

export const routes: Routes = [
    {path: '', loadComponent: () => import('./components/login/login.component').then(l => l.LoginComponent)},
    {path: 'verificar', loadComponent: () => import('./components/verficar-login/verficar-login.component').then(v => v.VerficarLoginComponent)},
    {path: 'registrar', loadComponent: () => import('./components/register/register.component').then(r => r.RegisterComponent) },
    {path: 'dashboard', loadComponent: () => import('./components/dashboard/dashboard.component').then(d => d.DashboardComponent), canActivate: [authGuard]},
    {path: 'ver-inventario', loadComponent: () => import('./components/view-inventario/view-inventario.component').then(vi => vi.ViewInventarioComponent), canActivate: [authGuard]},
    {path: 'ver-misiones', loadComponent: () => import('./components/view-misiones/view-misiones.component').then(vm => vm.ViewMisionesComponent), canActivate: [authGuard]},
    {path: 'ver-jugadores', loadComponent: () => import('./components/view-usuarios/view-usuarios.component').then(vu => vu.ViewUsuariosComponent), canActivate: [authGuard]},
    {path: 'ver-recompensas', loadComponent: () => import('./components/view-recompensas/view-recompensas.component').then(vr => vr.ViewRecompensasComponent), canActivate: [authGuard]},
    {path: 'ver-armas', loadComponent: () => import('./components/view-armas/view-armas.component').then(va => va.ViewArmasComponent), canActivate: [authGuard]},
    {path: 'ver-logs', loadComponent: () => import('./components/logs/logs.component').then(lo => lo.LogsComponent), canActivate: [authGuard]},
    {path: 'form-misiones', loadComponent: () => import('./components/nuevo-formulario-mision/nuevo-formulario-mision.component').then(fm => fm.NuevoFormularioMisionComponent), canActivate: [authGuard]},
    {path: 'form-misiones/:id', loadComponent: () => import('./components/nuevo-formulario-mision/nuevo-formulario-mision.component').then(fm => fm.NuevoFormularioMisionComponent), canActivate: [authGuard]},
    {path: 'form-armas', loadComponent: () => import('./components/form-armas/form-armas.component').then(fa => fa.FormArmasComponent), canActivate: [authGuard]},
    {path: 'form-armas/:id', loadComponent: () => import('./components/form-armas/form-armas.component').then(fa => fa.FormArmasComponent), canActivate: [authGuard]},
    {path: 'form-heroes', loadComponent: () => import('./components/form-heroes/form-heroes.component').then(fh => fh.FormHeroesComponent), canActivate: [authGuard]},
    {path: 'form-inventario', loadComponent: () => import('./components/form-inventario/form-inventario.component').then(fi => fi.FormInventarioComponent), canActivate: [authGuard]},
    {path: 'form-recompensas', loadComponent: () => import('./components/form-recompensas/form-recompensas.component').then(fr => fr.FormRecompensasComponent), canActivate: [authGuard]},
    {path: 'form-clanes', loadComponent: () => import('./components/form-clanes/form-clanes.component').then(fc => fc.FormClanesComponent), canActivate: [authGuard]},
    {path: 'editar-inventario', loadComponent: () => import('./components/form-inventario/form-inventario.component').then(fi => fi.FormInventarioComponent), canActivate: [authGuard]},
    {path: 'editar-usuario/:id', loadComponent: () => import('./components/editar-usuario/editar-usuario.component').then(eu => eu.EditarUsuarioComponent), canActivate: [authGuard]}
];