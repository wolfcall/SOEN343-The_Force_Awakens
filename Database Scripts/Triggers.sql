
Drop procedure if exists check_waitpro;
Delimiter $$
Create procedure check_waitpro (startTime DATETIME, endTime DATETIME, rmID INT(11))
begin
	Update reservation
		set waitlisted = false
        where reservation.startTimeDate = startTime
			and reservation.endTimeDate = endTime
            and reservation.roomID = rmID;
end$$

Drop trigger if exists check_waitlist$$

create trigger soen343.check_waitlist before delete on reservation
for each row 
begin
	call check_waitpro(OLD.startTimeDate, OLD.endTimeDate, OLD.roomID);
end;
