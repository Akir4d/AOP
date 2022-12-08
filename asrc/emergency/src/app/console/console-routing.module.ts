import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ConsoleComponent } from './console.component';
import { HomeComponent } from './home/home.component';
import { AdminComponent } from './admin/admin.component';

const routes: Routes = [
  {
    path: '',
    component: ConsoleComponent,
    children: [
      {
        path: 'admin',
        component: AdminComponent
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
