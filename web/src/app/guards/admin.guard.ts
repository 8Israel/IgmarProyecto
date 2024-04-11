
import { ActivatedRouteSnapshot, CanActivate, CanActivateFn, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { UserService } from '../services/user.service';
import { Injectable } from '@angular/core';
import { Observable, map } from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class AdminGuard implements CanActivate {
  
  constructor(private router: Router, private userService: UserService) { }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean | UrlTree> {
    return this.userService.getDataGuard().pipe(
      map((response) => {
        if (response.role_id !== 1) {
          return this.router.createUrlTree(['']);
        } else {
          return true;
        }
      })
    );
  }
}
