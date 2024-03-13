import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewMisionesComponent } from './view-misiones.component';

describe('ViewMisionesComponent', () => {
  let component: ViewMisionesComponent;
  let fixture: ComponentFixture<ViewMisionesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ViewMisionesComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ViewMisionesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
