import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewRecompensasComponent } from './view-recompensas.component';

describe('ViewRecompensasComponent', () => {
  let component: ViewRecompensasComponent;
  let fixture: ComponentFixture<ViewRecompensasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ViewRecompensasComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(ViewRecompensasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
