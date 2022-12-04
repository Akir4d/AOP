import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ConsoleComponent } from './console.component';
import { HomeComponent } from './home/home.component';

const usersModule = () => import('./users/users.module').then(x => x.UsersModule);
const routes: Routes = [
  {
    path: '',
    component: ConsoleComponent,
    children: [
      {
        path: 'admin',
        loadChildren: usersModule
      },
      {
        path: '**',
        component: HomeComponent
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
  providers: [
    ConsoleComponent
  ]
})
export class ConsoleRoutingModule { }
