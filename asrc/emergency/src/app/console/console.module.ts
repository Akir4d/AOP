import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ConsoleRoutingModule } from './console-routing.module';
import { ConsoleComponent } from './console.component';
import {AccordionModule} from 'primeng/accordion';
import {CardModule} from 'primeng/card';
import {InputTextModule} from 'primeng/inputtext';
import {StyleClassModule} from 'primeng/styleclass';
import {ButtonModule} from 'primeng/button';

@NgModule({
  declarations: [
    ConsoleComponent
  ],
  bootstrap:[
    ConsoleComponent
  ],
  imports: [
    CommonModule,
    ConsoleRoutingModule,
    AccordionModule,
    CardModule,
    InputTextModule,
    RouterModule,
    StyleClassModule,
    ButtonModule
  ]
})
export class ConsoleModule { }
