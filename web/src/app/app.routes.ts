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
    {path: 'ver-jugadores', loadComponent: () => import('./components/view-usuarios/view-usuarios.component').then(vu => vu.ViewUsuariosComponent)}
    
];
