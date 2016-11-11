
/*Drop trigger if exists check_Conflicts;
Delimiter $$
Create trigger soen343.checkConflicts before insert on reservation
for each row 
begin
	If (Select COUNT(*) FROM reservation
			where startTimeDate = New.startTimeDate
            and   endTimeDate = New.endTimeDate) >= 1 THEN
		Set NEW.waitlisted = true;
        Show message 'waitlisted';
    END IF;
end$$

Drop trigger if exists check_waitlist$$

create trigger soen343.check_waitlist before delete on reservation
for each row 
begin
	call check_waitpro(OLD.startTimeDate, OLD.endTimeDate, OLD.roomID);
end;*/
