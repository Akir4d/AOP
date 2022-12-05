import { ChangeDetectionStrategy, Component } from '@angular/core';
import { AccountService } from '@app/_services';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class SidebarComponent {

  constructor(private accountService: AccountService) {
  }
  
  logout() {
    this.accountService.logout();
  }
}
