import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '@app/_modules/helpers';

const accountModule = () => import('@app/login/login.module').then(x => x.AccountModule);

const routes: Routes = [
    { path: 'login', loadChildren: accountModule },
    { path: 'console', loadChildren: () => import('./console/console.module').then(m => m.ConsoleModule), canActivate: [AuthGuard] },

    // otherwise redirect to home
    { path: '**', redirectTo: 'console' }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }
